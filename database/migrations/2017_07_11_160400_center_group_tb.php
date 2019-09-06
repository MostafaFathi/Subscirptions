<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CenterGroupTb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('center_group_tb', function (Blueprint $table) {
            $table->increments('group_id');
            $table->string('group_name');
            $table->date('group_start_date');
            $table->integer('emp_id');
            $table->integer('branch_id');
            //$table->integer('appointment_id');
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
        Schema::dropIfExists('center_group_tb');
    }
}
