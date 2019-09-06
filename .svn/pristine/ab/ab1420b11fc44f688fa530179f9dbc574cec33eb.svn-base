<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenterEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('center_employee_tb', function (Blueprint $table) {
            $table->increments('emp_id');
            $table->string('emp_name');
            $table->string('emp_specialist')->nullable();
            $table->integer('emp_age')->nullable();
            $table->string('emp_gender',2)->default('m');
            $table->integer('emp_experiance')->nullable();
            $table->date('emp_graduate_year')->nullable();
            $table->integer('emp_phone')->nullable();
            $table->string('emp_email')->nullable();
            $table->string('emp_img')->nullable();

            $table->integer('branch_id')->nullable();
            $table->integer('salaray_id')->nullable();
            $table->integer('job_id')->nullable();

            $table->foreign('branch_id')->references('branch_id')->on('center_branch_tb');
            $table->foreign('salaray_id')->references('salary_id')->on('center_salaray_tb');
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
        Schema::dropIfExists('center_employee_tb');
    }
}
