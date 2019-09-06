<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenterBranchSalarayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */



    public function up()
    {
        Schema::create('center_branch_salaray_tb', function (Blueprint $table) {
            $table->increments('tag_no');

            $table->integer('salaray_id');
            $table->integer('branch_id');

            $table->foreign('salaray_id')->references('salaray_id')->on('center_salaray_tb');
            $table->foreign('branch_id')->references('branch_id')->on('center_branch_tb');

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
        Schema::dropIfExists('center_branch_salaray_tb');
    }
}
