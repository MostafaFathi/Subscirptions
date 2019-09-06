<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenterSalarayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */





    public function up()
    {
        Schema::create('center_salaray_tb', function (Blueprint $table) {
            $table->increments('salary_id');
            $table->integer('emp_id');
            $table->integer('salaray_type');
            $table->integer('salary_month')->nullable();
              $table->string('salaray_type_name')->nullable();
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
        Schema::dropIfExists('center_salaray_tb');
    }
}
