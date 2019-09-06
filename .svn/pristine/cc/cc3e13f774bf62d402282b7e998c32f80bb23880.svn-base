<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenterPermissionsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */




    public function up()
    {
        Schema::create('center_permissions_users_tb', function (Blueprint $table) {
            $table->increments('tag_no');

            $table->integer('permission_no');
            $table->integer('user_id');

            $table->foreign('permission_no')->references('permission_no')->on('center_permissions_tb');
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
        Schema::dropIfExists('center_permissions_users_tb');
    }
}
