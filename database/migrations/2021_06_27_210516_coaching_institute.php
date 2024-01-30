<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CoachingInstitute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coachings',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('added_by')->nullable();
            $table->unsignedBigInteger('main_course_id')->nullable();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('courses')->nullable();
            $table->string('categories')->nullable();
            $table->string('cities')->nullable();

            $table->string('address')->nullable();
            $table->string('landmark')->nullable();
            $table->string('district')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('pincode',6)->nullable();
            $table->string('latitude',24)->nullable();
            $table->string('longitude',24)->nullable();

            $table->string('email')->unique()->nullable();
            $table->string('website')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('landline_number')->nullable();
            $table->string('phone',24)->unique()->nullable();
            $table->string('alternate_phone',24)->nullable();

            $table->string('institute_status')->nullable();
            $table->string('establishment')->nullable();
            $table->bigInteger('total_branches')->nullable();
            $table->string('head_organisation')->nullable();
            $table->text('tandc')->nullable();

            $table->text('about')->nullable();
        // $table->text('test_process')->nullable();
            $table->bigInteger('batch_strength')->nullable();
            $table->boolean('library_facility')->default(false);
            $table->boolean('transport_facility')->default(false);
            $table->boolean('boys_hostel')->default(false);
            $table->boolean('girls_hostel')->default(false);
            $table->string('total_area')->nullable();

            $table->string('modes_of_payment')->nullable();
            $table->boolean('institute_management_system')->default(false);
            $table->boolean('doubt_and_revision_class')->default(true);

            //Classroom facility
            $table->boolean('ac_available')->default(false);
            $table->boolean('projector_available')->default(false);
            $table->boolean('biometric_attendence')->default(false);
            $table->boolean('cctv_with_recording')->default(false);
            $table->boolean('audio_system_available')->default(false);

            //Study material and test facility
            $table->boolean('study_material')->default(false);
            $table->boolean('scholarship_admission_process')->default(false);
            $table->boolean('class_test')->default(false);
            $table->boolean('online_test')->default(false);
            $table->boolean('offline_test')->default(false);

            $table->string('thumbnail')->nullable();
            $table->string('logo')->nullable();
            $table->text('gallery')->nullable();
            $table->text('videos')->nullable();

            $table->string('password',256)->nullable();

            $table->boolean('is_active')->default(true);
            $table->boolean('is_deleted')->default(false);
            $table->enum('status',['pending','approved','rejected'])->default('pending');


            $table->index('added_by');
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
        //
    }
}
