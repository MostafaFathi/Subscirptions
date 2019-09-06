<?php
namespace App\Http\Controllers;



use App\Center_branch_tb;
use App\Center_branch_users_tb;
use App\Center_employee_tb;
use App\Center_group_tb;
use App\Center_opening_tb;
use App\Center_permissions_tb;
use App\Center_permissions_users_tb;
use App\Center_students_tb;
use App\Educational_center_tb;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CommonFunctions{

    public static function get_permissions()
    {
        $permissions = Center_permissions_users_tb::where('user_id','=',Auth::user()->id)->get();
        $all_permissions = Center_permissions_tb::all();
        $permission_array = array();
        $operation = array();

        foreach ($all_permissions as $item) {
            $flag = false;
            foreach ($permissions as $item2) {
                if($item2->permission_no == $item->permission_no && $item->is_operation == 0){
                    $flag= true;
                }
                if($flag){
                    foreach ($all_permissions as  $all_permission) {
                        if($item2->permission_no == $all_permission->permission_parent_no && $all_permission->is_operation == 1){
                            foreach ($permissions as $permission) {
                                if($all_permission->permission_no == $permission->permission_no){
                                    array_push($operation,$all_permission->permission_name);
                                }
                            }

                        }
                    }
                    if(count($operation) > 0){
                        $permission_array['Screen_'.$item2->permission_no]=$operation;
                    }else{
                        $permission_array['Screen_'.$item2->permission_no]=['Screen_'.$item2->permission_no];
                    }

                    $operation = array();
                    $flag = false;
                }
            }

        }

        session(['permissions'=>$permission_array]);
    }

    // ask if the user has permissions in the session , and what are this permissions
    public static function has_permissions($screen_no, $operations = array(),$permission_level='operation_level')
    {
        $flag= false;
        $permission_array = session()->get('permissions');
        if($permission_level == 'screen_level' && isset($permission_array[$screen_no])){ // if screen level mean you search without operations
            return true;
        }
        if(isset($permission_array[$screen_no])){
            foreach ($permission_array[$screen_no] as $item) {
                foreach ($operations as $operation) {
                    if($item == $operation){
                        $flag = true;
                        break;
                    }
                }
                if($flag)break;
            }
        }

        return $flag;
    }

    public static function get_open_end_dates()
    {
       $center_id = Auth::user()->center_id;
        $last_open = Center_opening_tb::where('center_id','=',$center_id)->orderBy('id','desc')->first();
        $open_start_date=null;
        $open_end_date = null;
        $opening_date = array();
        if($last_open != null){
            $opening_date = ['open_start_date'=>$last_open->open_start_date,'open_end_date'=>$last_open->open_end_date];
        }else{
            $education_center = Educational_center_tb::where('center_id','=',$center_id)->first();
            if(!empty($education_center))
                $opening_date = ['open_start_date'=>$education_center->first_open_date,'open_end_date'=>$open_end_date];
            else
                $opening_date = ['open_start_date'=>'أول دخول','open_end_date'=>$open_end_date];

        }
        session($opening_date);

    }
    //check if the user has this center
    static  function  checkUserCenter($id)
    {
        $user_center = User::where('center_id','=',Auth::user()->center_id)->where('id','=',$id)->get();
        if(count($user_center) > 0)
            return true;
        else
            return false;

    }
    //check if the center of the user has a specific branch
    static function checkCenterBranch($id)
    {
        $center_branch = Center_branch_tb::where('center_id','=',Auth::user()->center_id)->where('branch_id','=',$id)->get();

        if(count($center_branch) > 0)
            return true;
        else
            return false;
    }

    // check if the branch primary or secondary
   static public function isPrimaryBranch($id)
    {
        $primary_branch = Center_branch_tb::where('branch_id','=',$id)->where('branch_type','=','primary')->get();
        if(count($primary_branch) > 0)
            return true;
        else
            return false;
    }

    static public function checkStudentBranch($student_id)
    {
        $user_branches = Center_branch_users_tb::where('user_id','=',Auth::user()->id)->get();
        $arr = array();
        foreach ($user_branches as $branch) {
            array_push($arr,$branch->branch_id);

        }
        $all_students = Center_students_tb::whereIn('branch_id',$arr)->where('student_id','=',$student_id)->get();
        if(count($all_students) > 0)
            return true;
        else
            return false;

    }

    static public function checkEmployeeBranch($emp_id)
    {
        $user_branches = Center_branch_users_tb::where('user_id','=',Auth::user()->id)->get();
        $arr = array();
        foreach ($user_branches as $branch) {
            array_push($arr,$branch->branch_id);

        }
        $all_employee = Center_employee_tb::whereIn('branch_id',$arr)->where('emp_id','=',$emp_id)->get();
        if(count($all_employee) > 0)
            return true;
        else
            return false;

    }

    public static function checkGroupBranch($group_id)
    {
        $user_branches = Center_branch_users_tb::where('user_id','=',Auth::user()->id)->get();
        $arr = array();
        foreach ($user_branches as $branch) {
            array_push($arr,$branch->branch_id);

        }

        $all_groups = Center_group_tb::whereIn('branch_id',$arr)->where('group_id','=',$group_id)->get();
        if(count($all_groups) > 0)
            return true;
        else
            return false;
    }

    public static function vary_names($number,$name_0,$name_1,$name_2,$name_between_3_10,$name_large_10)
    {
        $output = '';
        if($number == 0)
            return '<span class="label label-default">'.$name_0.'</span>';
        if($number == 1)
            return '<span class="label label-info">'.$name_1.'</span>';

        if ($number == 2)
            return '<span class="label label-info">'.$name_2.'</span>';

        if($number > 2 && $number < 11)
            return '<span class="label label-info">'.$number.' '.$name_between_3_10.'</span>';

        if($number > 10)
            return '<span class="label label-info">'.$number.' '.$name_large_10.'</span>';
    }

    public static function is_appointment_found($group_appointments,$day_no)
    {
    $day = 0;
    $from = '0';
    $to = '0';
        foreach($group_appointments as $item){
            if($item->day_no == $day_no){
            $day = $item->day_no;
            $from = $item->time_from;
            $to = $item->time_to;
                return collect(['day'=>$day,'from'=>$from,'to'=>$to]);
            }
        }

    }
}