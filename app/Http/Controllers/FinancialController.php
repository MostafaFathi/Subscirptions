<?php

namespace App\Http\Controllers;

use App\Center_branch_users_tb;
use App\Center_employee_tb;
use App\Center_group_tb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinancialController extends Controller
{
    public function index()
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
        return view('financial.salary_statement',['teachers'=>collect($teachers)]);
    }

    public function salary_statement($teacher_id)
    {
        if(!CommonFunctions::checkEmployeeBranch($teacher_id)){
            return 'صفحة غير موجودة';
        }

        $data = Center_group_tb::where('emp_id','=',$teacher_id)->get();
        return view('financial.teacher_salary_statement',['data'=>$data]);
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
}
