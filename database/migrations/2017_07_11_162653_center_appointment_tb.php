<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CenterAppointmentTb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('center_appointment_tb', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id');
            $table->integer('day_no');
            $table->string('time_from');
            $table->string('time_to');
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
        Schema::dropIfExists('center_appointment_tb');
    }
}
