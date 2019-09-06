<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenterPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */





    public function up()
    {
        Schema::create('center_permissions_tb', function (Blueprint $table) {
            $table->increments('permission_no');
            $table->string('permission_name');
            $table->integer('permission_parent_no')->nullable();
            $table->string('permission_type')->default('child');
            $table->integer('is_operation')->default(0);
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
        Schema::dropIfExists('center_permissions_tb');
    }
}
