<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tutor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutors',function(Blueprint $table){
            $table->id();
            $table->string('course');
            $table->string('name');
            $table->string('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone',10);
            $table->string('email')->nullable();
            $table->string('alternate_phone',24)->nullable();
            $table->text('present_address')->nullable();
            $table->text('qualification_details')->nullable();
            $table->string('city')->nullable();
            $table->string('fee_per_hour')->nullable();
            $table->string('fee_per_month')->nullable();
            $table->string('teaching_experience',3)->nullable();
            $table->string('tandc')->nullable();
            $table->string('thumbnail')->nullable();
            $table->text('gallery')->nullable();
            $table->text('about')->nullable();
            $table->string('password')->nullable();
            $table->timestamps();

            // $table->index('course_id');
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
