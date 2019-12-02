<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_id')->nullable();
            $table->string('user_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('product_name')->nullable();
            $table->float('product_price')->nullable();
            $table->integer('unit_id')->nullable();
            $table->string('city')->nullable();
            $table->string('img')->nullable();
            $table->integer('quantity')->nullable();
            $table->float('buy_cost')->nullable();
            $table->float('cartTotalCost')->nullable();
            $table->string('address')->nullable();
            $table->integer('is_seen')->default(0);
            $table->integer('is_confirmed')->default(0);
            $table->integer('is_others')->default(0);
            $table->string('order_other')->nullable();
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
        Schema::dropIfExists('requests');
    }
}
