<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FacultyStaff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_staff',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('coaching_id');
            $table->string('name',124);
            $table->string('designation');
            $table->string('specialization_on');
            $table->string('university')->nullable();
            $table->string('college')->nullable();
            $table->string('experience_in_years')->nullable();
            $table->string('job_type')->nullable();
            $table->text('achivements')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->index('coaching_id');
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
