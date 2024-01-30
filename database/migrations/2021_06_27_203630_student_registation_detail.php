<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StudentRegistationDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_registration_details',function(Blueprint $table){
            $table->id();
            $table->unsignedSmallInteger('coaching_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('user_id');

            $table->string('name',124);
            $table->date('dob');
            $table->string('gender',16);
            $table->string('category',16);
            $table->string('email',124);
            $table->string('mobile',16);

            $table->string('father_name',125);
            $table->string('occupation',64);
            $table->string('father_mobile',16)->nullable();

            $table->string('address');
            $table->string('city',124);
            $table->string('state',124);
            $table->string('district',64);
            $table->string('pincode',6);

            $table->string('session',64);
            $table->string('centre',124);
            $table->string('batch_type',42)->nullable();
            $table->string('exam',64);
            $table->string('stream',64)->nullable();
            $table->string('batch',42)->nullable();

            $table->string('qualification');
            $table->string('qualification_stream');
            $table->string('college_name');
            $table->string('passing_year');
            $table->string('marks');

            $table->string('photo');
            $table->string('signature');
            $table->string('id_proof');

            $table->timestamps();

            $table->index('coaching_id');
            $table->index('category_id');
            $table->index('course_id');
            $table->index('user_id');
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
