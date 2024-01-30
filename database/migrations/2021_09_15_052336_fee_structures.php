<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FeeStructures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_structures',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('coaching_id');
            $table->unsignedBigInteger('course_id')->nullable();
            $table->string('course_name')->nullable();
            $table->string('stream');
            $table->string('type')->nullable();
            $table->text('admission_process')->nullable();
            $table->date('batch_starting_date')->nullable();
            $table->string('course_duration')->nullable();
            $table->string('fees',8)->nullable();
            $table->string('scholarship_discount')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->index('coaching_id');
            $table->index('course_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
