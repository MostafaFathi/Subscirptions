<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenterBranchUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('center_branch_users_tb', function (Blueprint $table) {
            $table->increments('tag_no');

            $table->integer('branch_id');
            $table->integer('user_id');

            $table->foreign('branch_id')->references('branch_id')->on('center_branch_tb');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('center_branch_users_tb');
    }
}
