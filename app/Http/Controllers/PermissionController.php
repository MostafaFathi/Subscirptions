<?php

namespace App\Http\Controllers;

use App\Center_permissions_tb;
use App\Center_permissions_users_tb;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function index()
    {
        $parent_permissions = Center_permissions_tb::all();
        $all_permissions = DB::table('center_permissions_tb as row')
            ->select("row.permission_name as parent_name",
                "row.permission_no as parent_no",
                "parent.permission_name as row_name",
                "parent.permission_no as row_no",
                "parent.permission_type as row_type")
            ->leftJoin('center_permissions_tb as parent',function($leftJoin){
                $leftJoin->on( 'row.permission_no', '=', 'parent.permission_parent_no');
            })
            ->where('row.is_operation','=',0)->where('parent.is_operation','=',0)
            ->orderBy('parent.permission_no','asc')
            ->get();
        return view('permissions.permissions_manage',['all_permissions'=>$all_permissions,'parent_permissions'=>$parent_permissions]);
    }

    public function save(Request $request)
    {

        $permission = new Center_permissions_tb();
        $permission->permission_name = $request->input('permission_name');
        $permission->permission_parent_no = $request->input('permission_parent_no');
        $permission->is_operation = 0;
        $permission->permission_type = $request->input('permission_type');
        $permission->save();
        $permission_operations  = $request->input('permission_operations');
        $operation = array();
        if($permission_operations != null){
            foreach ($permission_operations as $item) {
                $operation = new Center_permissions_tb();
                $operation->permission_name = $item;
                $operation->permission_parent_no = $permission->permission_no;
                $operation->is_operation = 1;
                $operation->permission_type = 'operation';
                $operation->save();

            }
        }
        $permissions_result = Center_permissions_tb::where('is_operation','=',0)->get();
        $permissions_result = $this->get_select_options(collect($permissions_result));
        echo json_encode(['result'=>$permission,'permissions_result'=>$permissions_result]);

    }
    public function edit($id)
    {
        $permissions = Center_permissions_tb::find($id);
        $operations = Center_permissions_tb::where('permission_parent_no','=',$id)->where('is_operation','=',1)->get();
        echo json_encode(['result'=>$permissions,'operations'=>$operations]);

    }
    public function update(Request $request,$id)
    {
//        $id= $request->input('permission_no');
        $permission = Center_permissions_tb::find($id);
        $permission->permission_name = $request->input('permission_name');

        $permission->permission_parent_no = $request->input('permission_parent_no');
        $permission->is_operation = 0;
        $permission->permission_type = $request->input('permission_type');
        $permission->save();
        //delete all operations
        Center_permissions_tb::where('permission_parent_no','=',$id)->where('is_operation','=',1)->delete();
        $permission_operations  = $request->input('permission_operations');
        $operation = array();
        if($permission_operations != null){
            foreach ($permission_operations as $item) {
                $operation = new Center_permissions_tb();
                $operation->permission_name = $item;
                $operation->permission_parent_no = $id;
                $operation->is_operation = 1;
                $operation->permission_type = 'operation';
                $operation->save();

            }
        }
        $permissions_result = Center_permissions_tb::where('is_operation','=',0)->get();
        $permissions_result = $this->get_select_options(collect($permissions_result));
        echo json_encode(['result'=>$permission,'permissions_result'=>$permissions_result]);

    }

    public function users_list()
    {
        $center_id = Auth::user()->center_id;
        $all_users = User::where('center_id','=',$center_id)->get();
        return view("permissions.permissions_users",['all_users'=>$all_users]);

    }
    public function manage_tree($id)
    {
        $is_center_user = CommonFunctions::checkUserCenter($id);
        $user_permissions = array();
        if($is_center_user){
            $user_permissions = Center_permissions_users_tb::where('user_id','=',$id)->get();
        }else{
           return redirect('/permissions/users');
        }
        $tree = $this->get_permissions_tree($user_permissions);
        return view('permissions.permissions_tree',['tree'=>$tree,'user_id'=>$id]);
    }
    public function update_user_permissions(Request $request)
    {
        $id = $request->input('user_id');
        $permissions_checkboxes = $request->input('permission_check');
        $is_center_user = CommonFunctions::checkUserCenter($id);
        $result = 'fail';
        if($is_center_user){
            Center_permissions_users_tb::where('user_id','=',$id)->delete();
            if(count($permissions_checkboxes) > 0){
            foreach ($permissions_checkboxes as $item) {
            $user_permission = new Center_permissions_users_tb();
            $user_permission->user_id = $id;
            $user_permission->permission_no = $item;
            $user_permission->save();
            }
            }
            $result = 'success';
        }
        echo json_encode(['result'=>$result]);
    }
    // common functions
    public function get_permissions_tree($user_permissions)
    {
        $all_permissions = Center_permissions_tb::all();
        $tree = '<ol id="checkboxes">';
        foreach ($all_permissions as $item) {
            if($item->permission_parent_no != 0)
            break;
              if($this->has_childes($all_permissions,$item->permission_no))// ask if the permission has childes
              {
                  $checked = '';
                  $color = 'control-primary';
                  $background_color = 'unselected-permission';
                  $is_checked = 'not-checked';
                  $permission_name = $item->permission_name;
                  foreach ($user_permissions as $user_permission_item) {
                      if($user_permission_item->permission_no == $item->permission_no){
                          $checked = 'checked="checked"';
                          $color = 'control-success';
                          $background_color= 'success-permission';
                          $is_checked = 'yes-checked';
                          break;
                      }
                  }
                  if($item->is_operation == 1){
                      $permission_name = $this->translateOperations($item->permission_name);
                  }
                  $tree.='<li><span class="'.$background_color.'"><input type="checkbox" '.$checked.' class="'.$is_checked.' '.$color.' permission-checkbox menu-list" value="'.$item->permission_no.'" name="permission_check[]"/></span><span class="'.$background_color.' permission-name" style="margin: 5px;">'.$permission_name.'</span>';
                  $this->get_childes($all_permissions,$item->permission_no,$user_permissions);
                  $tree.=$this->childes.'</li>';
              }
         }
        $tree.='</ol>';
        return $tree;
    }

    // ask if the permission has childes
    public function has_childes($permissions, $permission_no)
    {
        $has_child = false;
        foreach ($permissions as $item) {
            if($item->permission_parent_no == $permission_no ){
                $has_child= true;
                break;
            }
        }
        return $has_child;
    }
    // get childes of the permissions
    public $childes;
    public function get_childes($permissions, $permission_no,$user_permissions)
    {
        $this->childes .= '<ul>';
        $sub = array();
        foreach ($permissions as $item){
            if($item->permission_parent_no == $permission_no )
                array_push($sub,$item);
        }
        foreach ($sub as $item) {
            $checked = '';
            $color = 'control-primary';
            $background_color = 'unselected-permission';
            $has_child = false;
            $operation = 'operation';
            $is_checked = 'not-checked';
           $permission_name =  $item->permission_name;
            foreach ($user_permissions as $user_permission_item) {
                if($user_permission_item->permission_no == $item->permission_no){
                    $checked = 'checked="checked"';
                    $color = 'control-success';
                    $background_color= 'success-permission';
                    $is_checked = 'yes-checked';
                    break;
                }
            }
            if($item->is_operation == 1){
                $permission_name = $this->translateOperations($item->permission_name);
            }
            if($this->has_childes($permissions ,$item->permission_no)){
                $has_child = true;
                $operation = 'menu-list';
            }
            $this->childes.='<li><span class="'.$background_color.'"><input type="checkbox" '.$checked.' class="'.$is_checked.' '.$color.'  permission-checkbox '.$operation.'" value="'.$item->permission_no.'" name="permission_check[]"/></span><span class="'.$background_color.' permission-name"  style="margin: 5px;">'.$permission_name.'</span>';
            if($has_child)
            {
                $this->get_childes($permissions,$item->permission_no,$user_permissions);
            }
            $this->childes.='</li>';
        }
        $this->childes .='</ul>';
    }


    public function get_select_options($data)
    {
        return (string) $data->map(function($item,$key){
            return "<option value='".$item->permission_no."'>".$item->permission_name."</option>";
        });

    }

    public function translateOperations($operation)
    {
        switch ($operation){
            case "Add":return "<span class='icon-plus-circle2'></span> إضافة بيانات"; break;
            case "Edit":return "<span class='icon-pencil7'></span> تعديل بيانات"; break;
            case "Delete":return "<span class=' icon-cancel-circle2'></span> حذف بيانات"; break;
            case "Show":return "<span class=' icon-menu6'></span> عرض بيانات"; break;
            case "Credence":return "<span class='icon-checkmark4'></span> إعتماد بيانات"; break;
            case "Grant":return "<span class=' icon-alignment-unalign'></span> منح صلاحيات"; break;
            default : return "إضافة بيانات";

        }
    }

}
