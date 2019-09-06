<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenterCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('center_courses_tb', function (Blueprint $table) {
            $table->increments('course_id');
            $table->string('course_name');

            $table->integer('level_id');

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
        Schema::dropIfExists('center_courses_tb');
    }
}
