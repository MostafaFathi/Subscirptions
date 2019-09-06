<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenterRecyclebinStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Center_student_recyclebin', function (Blueprint $table) {
            $table->increments('student_id');
            $table->string('student_name');
            $table->string('student_father_work')->nullable();
            $table->string('student_address',500)->nullable();
            $table->integer('student_phone')->nullable();
            $table->integer('student_phone2')->nullable();
            $table->integer('student_age')->nullable();
            $table->string('student_gender',2)->nullable();
            $table->date('student_reg_date')->nullable();
            $table->string('student_school')->nullable();

            $table->integer('branch_id');
            $table->integer('level_id');
            $table->foreign('branch_id')->references('branch_id')->on('center_branch_tb');
            $table->foreign('level_id')->references('level_id')->on('center_levels_tb');
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
        Schema::dropIfExists('Center_student_recyclebin');
    }
}
