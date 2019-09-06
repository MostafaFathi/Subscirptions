<?php

namespace App\Http\Controllers;

use App\Center_appointment_tb;
use App\Center_branch_tb;
use App\Center_branch_users_tb;
use App\Center_employee_tb;
use App\Center_group_students_tb;
use App\Center_group_tb;
use App\Center_students_tb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {
        $branches = Center_branch_users_tb::where('user_id','=',Auth::user()->id)->get();
        $arr = array();
        foreach ($branches as $branch) {
            array_push($arr,$branch->branch_id);

        }
        $date_now = date('Y-m-d');
        $all_students = Center_students_tb::whereIn('branch_id',$arr)->where('student_reg_date','>',session('open_start_date'))->get();
        $all_teachers = Center_employee_tb::whereIn('branch_id',$arr)->get();
        return view('groups.add_group',['students'=>$all_students,'teachers'=>$all_teachers,'branches'=>$branches,'date_now'=>$date_now]);
    }

    public function manage()
    {
        $branches = Center_branch_users_tb::where('user_id','=',Auth::user()->id)->get();
        $arr = array();
        foreach ($branches as $branch) {
            array_push($arr,$branch->branch_id);

        }
        $all_teachers = Center_employee_tb::whereIn('branch_id',$arr)->get();
        $groups = Center_group_tb::whereIn('branch_id',$arr)->get();

        $teachers = array();
        foreach ($all_teachers as $all_teacher) {
            $teachers[] = collect(array(
                'emp_id' => $all_teacher->emp_id,
                'emp_name' => $all_teacher->emp_name,
                'group_count' => $all_teacher->groups->count(),
                'student_count' => $this->teacher_total_students($all_teacher->emp_id, $groups)
            ));
        }
    return view('groups.manage_groups',['teachers'=>collect($teachers)]);
    }

    public function add_group_students($group)
    {
        $branches = Center_branch_users_tb::where('user_id','=',Auth::user()->id)->get();
        $arr = array();
        foreach ($branches as $branch) {
            array_push($arr,$branch->branch_id);

        }
        $all_students = Center_students_tb::whereIn('branch_id',$arr)->where('student_reg_date','>',session('open_start_date'))->get();
        $group_students = Center_group_students_tb::where('group_id','=',$group)->get();

        return view('groups.add_group_students',['students'=>$all_students,'group_students'=>$group_students,'group_id'=>$group]);
    }

    public function teacher_total_students($teacher_id,$groups)
    {
        $total_students = 0;
        foreach ($groups as $group) {
            if($teacher_id == $group->emp_id){
                $total_students+=$group->students->count();
            }
        }

        return $total_students;
}
    public function teacher_schedule($teacher)
    {
        if(!CommonFunctions::checkEmployeeBranch($teacher)){
            return 'صفحة غير موجودة';
        }

        $data = Center_group_tb::where('emp_id','=',$teacher)->get();
        return view('groups.manage_teacher_groups',['data'=>$data]);

    }

    public function groups_students($group)
    {
        if(!CommonFunctions::checkGroupBranch($group)){
            return 'صفحة غير موجودة';
        }
        $group_info = Center_group_tb::find($group);
        $group_students = Center_group_students_tb::where('group_id','=',$group)->get();
        return view('groups.manage_group_students',['group_students'=>$group_students,'group_info'=>$group_info]);

    }
    public function update_group($group)
    {
        if(!CommonFunctions::checkGroupBranch($group)){
            return 'صفحة غير موجودة';
        }
        $branches = Center_branch_users_tb::where('user_id','=',Auth::user()->id)->get();
        $arr = array();
        foreach ($branches as $branch) {
            array_push($arr,$branch->branch_id);

        }
        $all_students = Center_students_tb::whereIn('branch_id',$arr)->where('student_reg_date','>',session('open_start_date'))->get();
        $all_teachers = Center_employee_tb::whereIn('branch_id',$arr)->get();
        $group_info = Center_group_tb::where('group_id','=',$group)->first();
        $group_appointments = Center_appointment_tb::where('group_id','=',$group)->get();
        $group_students = Center_group_students_tb::where('group_id','=',$group)->get();
        return view('groups.update_group',['group'=>$group_info,'group_appointments'=>$group_appointments,'group_students'=>$group_students
        ,'students'=>$all_students,'teachers'=>$all_teachers,'branches'=>$branches]);

    }

    public function save(Request $request)
    {
        $this->validate($request,[
            'group_name'=>'required',
            'payemnt_value'=>'required',
            'group_start_date'=>'required'
        ]);
        $group = new Center_group_tb();
        $group->group_name  = $request->input('group_name');
        $group->group_start_date = $request->input('group_start_date');
        $group->emp_id = $request->input('emp_id');
        $group->branch_id = $request->input('branch_id');
        $group->save();


        $days = $request->input('day_time');
        if(count($days) > 0)
        foreach ($days as $item) {
            if($item[0] != null){
                $appointment = new Center_appointment_tb();
                $appointment->group_id = $group->group_id;
                $appointment->day_no = $item[0];
                $appointment->time_from = $item[1];
                $appointment->time_to = $item[2];
                $appointment->save();
            }

        }

        $students = $_POST['student_id'];
        if(count($students) > 0)
        for( $i=0; $i<count($students);$i++){
            $student = new Center_group_students_tb();

            $student->student_id = $_POST['student_id'][$i];
            $student->group_id = $group->group_id;;
            $student->payment_status = $_POST['payment_status'][$i];
            $student->payment_value = $_POST['payemnt_value'][$i];
            $student->save();
        }



       echo json_encode(['result'=>$students]);
    }

    public function edit(Request $request,$id)
    {
        $this->validate($request,[
            'group_name'=>'required',
            'payemnt_value'=>'required',
            'group_start_date'=>'required'
        ]);
        if(!CommonFunctions::checkGroupBranch($id)){
            return 'صفحة غير موجودة';
        }
        $group =  Center_group_tb::find($id);
        $group->group_name  = $request->input('group_name');
        $group->group_start_date = $request->input('group_start_date');
        $group->emp_id = $request->input('emp_id');
        $group->branch_id = $request->input('branch_id');
        $group->save();


        $days = $request->input('day_time');
        Center_appointment_tb::where('group_id','=',$id)->delete();
        if(count($days) > 0)
        foreach ($days as $item) {
            if($item[0] != null){
                $appointment = new Center_appointment_tb();
                $appointment->group_id = $group->group_id;
                $appointment->day_no = $item[0];
                $appointment->time_from = $item[1];
                $appointment->time_to = $item[2];
                $appointment->save();
            }

        }

        $students = $_POST['student_id'];
        Center_group_students_tb::where('group_id','=',$id)->delete();
        if(count($students) > 0)
        for( $i=0; $i<count($students);$i++){
            $student = new Center_group_students_tb();

            $student->student_id = $_POST['student_id'][$i];
            $student->group_id = $group->group_id;;
            $student->payment_status = $_POST['payment_status'][$i];
            $student->payment_value = $_POST['payemnt_value'][$i];
            $student->save();
        }



        echo json_encode(['result'=>$students]);
    }

    public function update_payment(Request $request)
    {
        $this->validate($request,[
            'payment_status'=>'required',
            'payemnt_value'=>'required'
        ]);
        $student_id = $request->input('student_id');
        $payment_status = $request->input('payment_status');
        $payment_value = $request->input('payemnt_value');

        if(!CommonFunctions::checkStudentBranch($student_id)){
            return 'صفحة غير موجودة';
        }
        Center_group_students_tb::where('student_id','=',$student_id)->update(['payment_status'=>$payment_status,'payment_value'=>$payment_value]);
        $update_info = ['student_id'=>$student_id,'payment_status'=>$payment_status,'payment_value'=>$payment_value];
        echo json_encode(['result'=>$update_info]);
    }

    public function remove_student_group($student_id,$group_id)
    {
        if(!CommonFunctions::checkStudentBranch($student_id)){
            return 'صفحة غير موجودة';
        }
        Center_group_students_tb::where('group_id','=',$group_id)->where('student_id','=',$student_id)->delete();
        echo json_encode(['result'=>'success']);

    }

    public function delete_group($group_id)
    {
        if(!CommonFunctions::checkGroupBranch($group_id)){
            return 'صفحة غير موجودة';
        }
        Center_group_students_tb::where('group_id','=',$group_id)->delete();
        Center_appointment_tb::where('group_id','=',$group_id)->delete();
        Center_group_tb::where('group_id','=',$group_id)->delete();
        echo json_encode(['result'=>'success']);


    }

    public function add_students_group(Request $request)
    {

        $group_id = $request->input('group_id');
        if(!CommonFunctions::checkGroupBranch($group_id)){
            return 'صفحة غير موجودة';
        }
        $students = null;
        if(isset($_POST['student_id'])){
        $students = $_POST['student_id'];
        if(count($students) > 0)
            for( $i=0; $i<count($students);$i++){
                $student = new Center_group_students_tb();

                $student->student_id = $_POST['student_id'][$i];
                $student->group_id = $group_id;;
                $student->payment_status = $_POST['payment_status'][$i];
                $student->payment_value = $_POST['payemnt_value'][$i];
                $student->save();
            }
        }


        echo json_encode(['result'=>$students]);
    }


}
