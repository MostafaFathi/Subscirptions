<?php

namespace App\Http\Controllers;

use App\Center_branch_users_tb;
use App\Center_employee_tb;
use App\Center_jobs_table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{

    public function index()
    {
        $jobs = Center_jobs_table::all();
        $branches = Center_branch_users_tb::where('user_id','=',Auth::user()->id)->get();
        return view('teachers.add_teacher',['branches'=>$branches,'jobs'=>$jobs]);
    }

    public function manage()
    {
        $branches = Center_branch_users_tb::where('user_id','=',Auth::user()->id)->get();
        $jobs = Center_jobs_table::all();
        $arr = array();
        foreach ($branches as $branch) {
            array_push($arr,$branch->branch_id);

        }
        $all_teachers = Center_employee_tb::whereIn('branch_id',$arr)->get();
        return view('teachers.manage_teachers',['all_teachers'=>$all_teachers,'branches'=>$branches,'jobs'=>$jobs]);
    }

    public function save(Request $request)
    {
        $this->validate($request,[
            'emp_name'=>'required'
        ]);
        $teacher = new Center_employee_tb();
        $teacher->emp_name  = $request->input('emp_name');
        $teacher->emp_gender = $request->input('emp_gender');
        $teacher->emp_age = $request->input('emp_age');
        $teacher->emp_specialist = $request->input('emp_specialist');
        $teacher->emp_experiance =  $request->input('emp_experiance');
        $teacher->emp_email = $request->input('emp_email');
        $teacher->emp_phone = $request->input('emp_phone');
        $teacher->branch_id = $request->input('branch_id');
        $teacher->job_id = $request->input('job_id');

        $teacher->save();


        echo json_encode(['result'=>'success','teacher'=>$teacher]);
    }
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'emp_name'=>'required'
        ]);
        $teacher = array();
        if(CommonFunctions::checkEmployeeBranch($id)){
            $teacher = Center_employee_tb::find($id);
            $teacher->emp_name  = $request->input('emp_name');
            $teacher->emp_gender = $request->input('emp_gender');
            $teacher->emp_age = $request->input('emp_age');
            $teacher->emp_specialist = $request->input('emp_specialist');
            $teacher->emp_experiance =  $request->input('emp_experiance');
            $teacher->emp_email = $request->input('emp_email');
            $teacher->emp_phone = $request->input('emp_phone');
            $teacher->branch_id = $request->input('branch_id');
            $teacher->job_id = $request->input('job_id');

            $teacher->save();
        }

        echo json_encode(['result'=>'success','emp'=>$teacher]);
    }
}
