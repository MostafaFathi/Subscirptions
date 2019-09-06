<?php

namespace App\Http\Controllers;

use App\Center_branch_users_tb;
use App\Center_levels_tb;
use App\Center_student_recyclebin;
use App\Center_students_tb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

    public function index()
    {
        $levels = Center_levels_tb::all();
        $branches = Center_branch_users_tb::where('user_id','=',Auth::user()->id)->get();
        $date_now = date('Y-m-d');
        return view('students.add_student',['branches'=>$branches,'levels'=>$levels,'date_now'=>$date_now]);
    }

    public function manage()
    {
        $branches = Center_branch_users_tb::where('user_id','=',Auth::user()->id)->get();
        $levels = Center_levels_tb::all();
        $arr = array();
        foreach ($branches as $branch) {
            array_push($arr,$branch->branch_id);

        }
        $all_students = Center_students_tb::whereIn('branch_id',$arr)->where('student_reg_date','>',session('open_start_date'))->get();
        return view('students.manage_students',['all_students'=>$all_students,'branches'=>$branches,'levels'=>$levels]);
    }

    public function recycle()
    {
        $branches = Center_branch_users_tb::where('user_id','=',Auth::user()->id)->get();
        $levels = Center_levels_tb::all();
        $arr = array();
        foreach ($branches as $branch) {
            array_push($arr,$branch->branch_id);

        }
        $all_students = Center_student_recyclebin::whereIn('branch_id',$arr)->get();
        return view('students.students_recycle_bin',['all_students'=>$all_students,'branches'=>$branches,'levels'=>$levels]);
    }

    public function basic_search($student_name)
    {

        if(!session()->has('branches')){
            $branches = Center_branch_users_tb::where('user_id','=',Auth::user()->id)->get();
            $arr = array();
            foreach ($branches as $branch) {
                array_push($arr,$branch->branch_id);

            }
            session(['branches'=>$arr]);
        }
//        if($student_name=='all'){
//            $all_students = Center_students_tb::whereIn('branch_id',session('branches'))->where('student_reg_date','<',session('open_start_date'))->get();
//
//        }else{
//            $all_students = Center_students_tb::whereIn('branch_id',session('branches'))->where('student_reg_date','<',session('open_start_date'))->where('student_name','like','%'.$student_name.'%')->get();
//
//        }
        $all_students = Center_students_tb::whereIn('branch_id',session('branches'))->where('student_reg_date','<',session('open_start_date'))->where('student_name','like','%'.$student_name.'%')->get();

        $students = '';
        foreach ($all_students as $item) {
            $students.='<li class="record">'.$item->student_name.'
                        <input type="hidden" class="list-student-id" value="'.$item->student_id.'"/>
                        <input type="hidden" class="list-student-name" value="'.$item->student_name.'"/>
                        <input type="hidden" class="list-student-father-work" value="'.$item->student_father_work.'"/>
                        <input type="hidden" class="list-student-address" value="'.$item->student_address.'"/>
                        <input type="hidden" class="list-student-phone" value="'.$item->student_phone.'"/>
                        <input type="hidden" class="list-student-phone2" value="'.$item->student_phone2.'"/>
                        <input type="hidden" class="list-student-age" value="'.$item->student_age.'"/>
                        <input type="hidden" class="list-student-gender" value="'.$item->student_gender.'"/>
                        <input type="hidden" class="list-student-reg-date" value="'.$item->student_reg_date.'"/>
                        <input type="hidden" class="list-student-school" value="'.$item->student_school.'"/>
                        <input type="hidden" class="list-student-level" value="'.$item->level_id.'"/>
                        <input type="hidden" class="list-student-branch" value="'.$item->branch_id.'"/>
                        </li>';
        }
        echo json_encode(['search-result'=>$students,'count-students'=>count($all_students)]);

    }
    public function save(Request $request)
    {
        $this->validate($request,[
            'student_name'=>'required'
        ]);
        $student = new Center_students_tb();
        $student->student_name  = $request->input('student_name');
        $student->student_address = $request->input('student_address');
        $student->student_father_work = $request->input('student_father_work');
        $student->student_phone = $request->input('student_phone');
        $student->student_phone2 =  $request->input('student_phone2');
        $student->student_age = $request->input('student_age');

        $student->student_gender = $request->input('student_gender');
        $student->student_reg_date = $request->input('student_reg_date');
        $student->student_school = $request->input('student_school');
        $student->branch_id = $request->input('branch_id');
        $student->level_id = $request->input('level_id');

        $student->save();


        echo json_encode(['result'=>'success','student'=>$student]);
    }
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'student_name'=>'required'
        ]);
        $student = array();
        if(CommonFunctions::checkStudentBranch($id)){
            $student = Center_students_tb::find($id);
            $student->student_name=$request->input('student_name');
            $student->student_address=$request->input('student_address');
            $student->student_father_work=$request->input('student_father_work');
            $student->student_phone=$request->input('student_phone');
            $student->student_phone2=$request->input('student_phone2');
            $student->student_age=$request->input('student_age');
            $student->student_gender=$request->input('student_gender');
            $student->student_reg_date=$request->input('student_reg_date');
            $student->student_school=$request->input('student_school');
            $student->branch_id=$request->input('branch_id');
            $student->level_id=$request->input('level_id');
            $student->save();
        }

        echo json_encode(['result'=>'success','student'=>$student]);
    }

    public function renew_registration(Request $request,$id)
    {
        $this->validate($request,[
            'student_name'=>'required'
        ]);
        $student = array();
         if(CommonFunctions::checkStudentBranch($id)){
            $student = Center_students_tb::find($id);
            $student->student_name=$request->input('student_name');
            $student->student_address=$request->input('student_address');
            $student->student_father_work=$request->input('student_father_work');
            $student->student_phone=$request->input('student_phone');
            $student->student_phone2=$request->input('student_phone2');
            $student->student_age=$request->input('student_age');
            $student->student_gender=$request->input('student_gender');
            $student->student_reg_date=$request->input('student_reg_date');
            $student->student_school=$request->input('student_school');
            $student->branch_id=$request->input('branch_id');
            $student->level_id=$request->input('level_id');
            $student->save();
        }

        echo json_encode(['result'=>'success','student'=>$student]);
    }

    public function recycle_bin($student_id)
    {
        $result = 'fail';
        if(CommonFunctions::checkStudentBranch($student_id)) {
            $student = Center_students_tb::find($student_id);
            $recycle_student = new Center_student_recyclebin();
            $recycle_student->student_name = $student->student_name;
            $recycle_student->student_address = $student->student_address;
            $recycle_student->student_father_work = $student->student_father_work;
            $recycle_student->student_phone = $student->student_phone;
            $recycle_student->student_phone2 = $student->student_phone2;
            $recycle_student->student_age = $student->student_age;
            $recycle_student->student_gender = $student->student_gender;
            $recycle_student->student_reg_date = $student->student_reg_date;
            $recycle_student->student_school = $student->student_school;
            $recycle_student->branch_id = $student->branch_id;
            $recycle_student->level_id= $student->level_id;
            $recycle_student->save();
            $student->delete();
            $result = 'success';
        }

        echo json_encode(['result'=>$result]);
    }

    public function undo_recycle_bin($student_id)
    {
        $result = 'fail';
        if(CommonFunctions::checkStudentBranch($student_id)) {
            $student =  Center_student_recyclebin::find($student_id);
            $recycle_student = new Center_students_tb();
            $recycle_student->student_name = $student->student_name;
            $recycle_student->student_address = $student->student_address;
            $recycle_student->student_father_work = $student->student_father_work;
            $recycle_student->student_phone = $student->student_phone;
            $recycle_student->student_phone2 = $student->student_phone2;
            $recycle_student->student_age = $student->student_age;
            $recycle_student->student_gender = $student->student_gender;
            $recycle_student->student_reg_date = $student->student_reg_date;
            $recycle_student->student_school = $student->student_school;
            $recycle_student->branch_id = $student->branch_id;
            $recycle_student->level_id= $student->level_id;
            $recycle_student->save();
            $student->delete();
            $result = 'success';
        }

        echo json_encode(['result'=>$result]);
    }

}
