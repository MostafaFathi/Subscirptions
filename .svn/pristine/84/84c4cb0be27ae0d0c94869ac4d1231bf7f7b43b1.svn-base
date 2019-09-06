<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenterStudentCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */





    public function up()
    {
        Schema::create('center_student_course_tb', function (Blueprint $table) {
            $table->increments('tag_no');

            $table->integer('student_id');
            $table->integer('course_id');
            $table->integer('emp_id');

            $table->foreign('student_id')->references('student_id')->on('center_students_tb');
            $table->foreign('course_id')->references('course_id')->on('center_courses_tb');
            $table->foreign('emp_id')->references('emp_id')->on('center_employee_tb');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('center_student_course_tb');
    }
}
