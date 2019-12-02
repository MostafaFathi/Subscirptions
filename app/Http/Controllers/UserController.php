<?php

namespace App\Http\Controllers;

use App\Center_branch_tb;
use App\Center_branch_users_tb;
use App\Center_employee_tb;
use App\Center_students_tb;
use App\Educational_center_tb;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function manage(){
//        $users_array = User::where('is_delete' , '=' , 0 )->get();
        $users_array = User::all();
        $arr = ['users_array'=>$users_array];
        return view('users.show',$arr);
    }

    public function save(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:20|min:3|unique:users|alpha_num',
            'email' => 'required|email|unique:users',
            'password'=>'required|min:6|max:20',
            'phone'=>'min:7|max:12',
            'gender'=>'required',
          //  'branch_id'=>'required',
            'img'=>'mimes:jpeg,jpg,png,gif|max:20000|file|image'
        ]);
         $user = new User();
        $user->name  = $request->input('name');
        $user->password = bcrypt($request->input('password'));
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->gender = $request->input('gender');
        $user->img = 'default_user.png';

        if($request->file('img') != null){
        $image = $request->file('img');
        $filename  = time() . '.jpg' ;//. $image->getClientOriginalExtension();// get name and extention // save all images in jpg format

        $path = public_path('uploads/users/' . $filename);//-- string path


        Image::make($image->getRealPath())->resize(200, 200)->save($path);
        $user->img = $filename;
        }
        $user->save();

//        $user_branch = new Center_branch_users_tb();
//        $user_branch->user_id = $user->id;
//        $user_branch->branch_id = $request->input('branch_id');
//        $user_branch->save();

        echo json_encode(['result'=>'success','user'=>$user]);
    }


    public function delete($id)
    {
            $user = User::find($id);
            $user->delete($user);
            Center_branch_users_tb::where('user_id', '=', $id)->delete();
            $result = 'success';
        echo json_encode(['result'=>$result]);
    }

    public function edit($id)
    {
        $user_center = User::where('id','=',$id)->get();
        $result = $user_center;

        echo json_encode(['result'=>$result]);
    }

    public function update(Request $request)
    {
        $id =  $request->input('id');

            $result = 'success';
            $this->validate($request,[
                'name'=>'required|max:20|min:3|alpha_num',
                'email' => 'required|email',
                'password'=>'required|min:6|max:20',
                'phone'=>'min:7|max:12',
                'gender'=>'required',
                //  'branch_id'=>'required',
                'img'=>'mimes:jpeg,jpg,png,gif|max:20000|file|image'
            ]);
            $this->validate($request, [
                'email' => [
                    'required',
                    Rule::unique('users')->ignore($id),
                ],
                'name' => [
                    'required',
                    Rule::unique('users')->ignore($id),
                ],
            ]);
            $user = User::find($id);
            $user->name  = $request->input('name');
            $user->password = bcrypt($request->input('password'));
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->gender = $request->input('gender');
            if($request->file('img') != null){
                $image = $request->file('img');
                $filename  = time() . '.jpg' ;//. $image->getClientOriginalExtension();// get name and extention // save all images in jpg format

                $path = public_path('uploads/users/' . $filename);//-- string path


                Image::make($image->getRealPath())->resize(200, 200)->save($path);
                $user->img = $filename;
            }
            $user->save();

          echo json_encode(['result'=>$result,'user'=>$user]);

    }


    public function manageBranches()
    {
        $center_id = Auth::user()->center_id;

        $users_array = User::where('center_id' , '=' , $center_id )->get();
        $branches = Center_branch_tb::where('center_id' , '=' , $center_id)->get();

        $center_info = Educational_center_tb::where('center_id','=',$center_id)->first();
        $arr = ['users_array'=>$users_array,'branches'=>$branches,'center_info' => $center_info];
      return view('users.user-branche',$arr);
    }

    public function saveBranches(Request $request)
    {

        $this->validate($request,[
            'branch_name'=>'required',
             'branch_phone'=>'min:7|max:10'
        ]);
        $center_id = Auth::user()->center_id;
        $branch = new Center_branch_tb();
        $branch->branch_name  = $request->input('branch_name');
        $branch->branch_phone  = $request->input('branch_phone');
        $branch->branch_address  = $request->input('branch_address');
        $branch->center_id = $center_id;
        $branch->save();

//        $user_branch = new Center_branch_users_tb();
//        $user_branch->user_id = $user->id;
//        $user_branch->branch_id = $request->input('branch_id');
//        $user_branch->save();

        echo json_encode(['result'=>'success','branch'=>$branch]);
    }

    public function deleteBranch($id,$cascade)
    {
        $result = 'fail';
        $flag = $this->checkCenterBranch($id);
       // echo json_encode($flag);
        if($flag) {
            $is_primary = $this->isPrimaryBranch($id);
            if(!$is_primary){// if ite is secondary branch , delete it
                Center_branch_tb::where('branch_id','=',$id)->where('branch_type','=','secondary')->delete();
                if($cascade == 'true'){
                    Center_students_tb::where('branch_id','=',$id)->delete();
                    Center_employee_tb::where('branch_id','=',$id)->delete();
                }else{
                    $primary_branch1 = Center_branch_tb::where('center_id','=',Auth::user()->center_id)->where('branch_type','=','primary')->first();
                    Center_students_tb::where('branch_id','=',$id)->update(['branch_id'=>$primary_branch1->branch_id]);

                    $primary_branch2 = Center_branch_tb::where('center_id','=',Auth::user()->center_id)->where('branch_type','=','primary')->first();
                    Center_employee_tb::where('branch_id','=',$id)->update(['branch_id'=>$primary_branch2->branch_id]);
                }
                $result = 'success';

            }else{
                $result = 'primary';
            }

        }
        echo json_encode(['result'=>$result]);
    }

    public function updateBranch(Request $request)
    {
        $this->validate($request,[
            'branch_name'=>'required',
            'branch_phone'=>'min:7|max:10'
        ]);
        $branch_id = $request->input('branch_id');
        $flag = $this->checkCenterBranch($branch_id);
        $result = 'fail';
        $branch = '';
        if($flag){
        $branch = Center_branch_tb::where('branch_id','=',$branch_id)->update([
            'branch_name'=>$request->input('branch_name'),
            'branch_phone'=>$request->input('branch_phone'),
            'branch_address'=>$request->input('branch_address')
        ]);
            $branch = Center_branch_tb::where('branch_id','=',$branch_id)->first();
        $result = 'success';
        }

        echo json_encode(['result'=>$result,'branch'=>$branch]);
    }

    public function editBranch($id)
    {
        $center_branch = Center_branch_tb::where('center_id','=',Auth::user()->center_id)->where('branch_id','=',$id)->get();
//        $flag= false;
        $result = array();
        if (count($center_branch) > 0){
            $result = $center_branch;
        }
        echo json_encode(['result'=>$result]);
    }

    public function user_branches($id)
    {
        $user_branch = array();
        if(CommonFunctions::checkUserCenter($id)){
            $user_branch = Center_branch_users_tb::where('user_id','=',$id)->get();
    }
    echo json_encode(['user_branches'=>$user_branch]);
    }

    public function updateUserBranch(Request $request,$id)
    {
        $result = 'fail';
        if(CommonFunctions::checkUserCenter($id)){
            Center_branch_users_tb::where('user_id','=',$id)->delete();
            foreach ($request->input('branch_id') as $item) {
                $user_branch = new Center_branch_users_tb();
                $user_branch->user_id = $id;
                $user_branch->branch_id = $item;
                $user_branch->save();
                $result = 'success';
            }
        }
        echo json_encode(['result'=>$result]);
    }
    // common function ///////////////////////////////////////////////
    //check if the user has this center
     function checkUserCenter($id)
    {
        $user_center = User::where('center_id','=',Auth::user()->center_id)->where('id','=',$id)->get();
        if(count($user_center) > 0)
            return true;
        else
            return false;

    }

    //check if the center of the user has a specific branch
    function checkCenterBranch($id)
    {
        $center_branch = Center_branch_tb::where('center_id','=',Auth::user()->center_id)->where('branch_id','=',$id)->get();

        if(count($center_branch) > 0)
            return true;
        else
            return false;
    }

    // check if the branch primary or secondary
    public function isPrimaryBranch($id)
    {
        $primary_branch = Center_branch_tb::where('branch_id','=',$id)->where('branch_type','=','primary')->get();
        if(count($primary_branch) > 0)
            return true;
        else
            return false;
    }

}
