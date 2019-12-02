<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name');
            $table->float('product_price')->default(0);
            $table->integer('unit_id')->nullable()->default(1);
            $table->integer('product_section')->default(1);//خضروات وفواكه
            $table->integer('product_rest')->nullable();
            $table->integer('product_rest_branch')->nullable();
            $table->integer('product_city')->default(0);
            $table->string('img')->nullable();
            $table->string('img_2')->nullable();
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
        Schema::dropIfExists('products');
    }
}
