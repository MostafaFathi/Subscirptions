<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationalCenterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */



    public function up()
    {
        Schema::create('educational_center_tb', function (Blueprint $table) {
            $table->increments('center_id');
            $table->string('center_name');
            $table->string('center_address',500)->nullable();
            $table->string('center_cover_img')->nullable();
            $table->integer('center_phone')->nullable();
            $table->string('center_email')->nullable();
            $table->string('center_owner')->nullable();
            $table->string('status')->default('active');
            $table->date('first_open_date')->nullable();

             $table->integer('center_user_id');

             $table->foreign('center_user_id')->references('id')->on('users');
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
        Schema::dropIfExists('Educational_Center_TB');
    }
}
