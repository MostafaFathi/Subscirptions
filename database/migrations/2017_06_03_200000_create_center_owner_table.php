<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenterOwnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */


    public function up()
    {
        Schema::create('center_owner_tb', function (Blueprint $table) {
            $table->increments('center_owner_id');
            $table->string('center_owner_name');
            $table->string('center_owner_address',500)->nullable();
            $table->integer('center_owner_phone')->nullable();
            $table->integer('center_owner_age')->nullable();
            $table->string('center_owner_gender',2)->nullable();
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
        Schema::dropIfExists('center_owner_tb');
    }
}
