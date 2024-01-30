<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SelectedStudentsAndAchivements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_and_achivements',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('coaching_id');
            $table->unsignedBigInteger('course_id')->nullable();
            $table->enum('data_type',['result','achivement'])->default('achivement');
            $table->string('exam_year',4)->nullable();
            $table->string('type')->nullable();
            $table->string('stream')->nullable();
            $table->string('student_name')->nullable();
            $table->string('rank')->nullable();
            $table->string('percentage',64)->nullable();
            $table->string('selected_in_pt',8)->nullable();
            $table->string('selected_in_mains',8)->nullable();
            $table->string('selected_in_final',8)->nullable();
            $table->string('selected_in_top_ten',8)->nullable();
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
