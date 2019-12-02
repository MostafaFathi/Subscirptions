<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rest_name');
            $table->string('main_section')->default(0);
            $table->string('has_branches')->default(0);
            $table->string('is_branch')->default(0);
            $table->string('branch_id')->default(0);
            $table->float('discount')->default(0);
            $table->string('img')->nullable();
            $table->string('img2')->nullable();
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
        Schema::dropIfExists('restaurants');
    }
}
