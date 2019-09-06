<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenterEmployeeSalarayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */











    public function up()
    {
        Schema::create('center_employee_salaray_tb', function (Blueprint $table) {
            $table->increments('tag_no');
            $table->integer('student_id');
            $table->integer('group_id');
            $table->string('salary_payment_status')->default('N');
            $table->float('salary_payment_value')->default(0);
            $table->float('salaray_ratio')->nullable();
            $table->integer('salaray_value')->nullable();

             $table->integer('user_inserted');
            $table->integer('user_updated');

             $table->foreign('user_inserted')->references('user_inserted')->on('users');
            $table->foreign('user_updated')->references('user_updated')->on('users');
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
        Schema::dropIfExists('center_employee_salaray_tb');
    }
}
