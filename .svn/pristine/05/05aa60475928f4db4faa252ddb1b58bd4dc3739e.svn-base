<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenterBranchTb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */







    public function up()
    {
        Schema::create('center_branch_tb', function (Blueprint $table) {
            $table->increments('branch_id');
            $table->string('branch_name');
            $table->string('branch_address',500)->nullable();
            $table->integer('branch_phone')->nullable();
            $table->string('branch_img')->nullable();
            $table->string('branch_type')->default('secondary');// primary will not be deleted
            $table->integer('center_id');

            $table->foreign('center_id')->references('center_id')->on('educational_center_tb');
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
        Schema::dropIfExists('center_branch_tb');
    }
}
