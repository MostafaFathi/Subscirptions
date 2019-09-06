<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CenterGroupStudentsTb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('center_group_students_tb', function (Blueprint $table) {
            $table->increments('tag_no');
            $table->integer('group_id');
            $table->integer('student_id');
            $table->string('payment_status')->default('N');//N: no , P: Partial Paid , F: Fully Paid
            $table->float('payment_value')->default(0);
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
        Schema::dropIfExists('center_group_students_tb');
    }
}
