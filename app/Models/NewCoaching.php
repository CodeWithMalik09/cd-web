<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewCoaching extends Model
{
    // use HasFactory;

    protected $fillable = [
        'added_by',
        'name',
        'slug',
        'main_course_id',
        'courses',
        'categories',
        'cities',
        'locality',
        'streams',
        'address',
        'landmark',
        'district',
        'state',
        'country',
        'pincode',
        'latitude',
        'longitude',
        'direction',

        'email',
        'website',
        'facebook_link',
        'youtube_link',
        'twitter_link',
        'landline_number',
        'phone',
        'alternate_phone',

        'institute_status',
        'establishment',
        'total_branches',
        'head_organisation',
        'tandc',
        'about',
        'doubt_and_revision_class',
        'batch_strength',
        'library_facility',
        'transport_facility',
        'boys_hostel',
        'girls_hostel',
        'total_area',

        'modes_of_payment',
        'institute_management_system',

        'ac_available',
        'projector_available',
        'biometric_attendence',
        'cctv_with_recording',
        'audio_system_available',

        'study_material',
        'scholarship_admission_process',
        'class_test',
        'online_test',
        'offline_test',

        'logo',
        'thumbnail',
        'gallery',
        'videos',
        'password',
        'updated_at',

        'status',
        'is_active',
        'is_deleted'
    ];

    public function mainCourse()
    {
        return $this->hasOne(Course::class, 'id', 'main_course_id');
    }

    public function coursecategories()
    {
        return $this->hasMany(NewCoachingsCourseCategory::class, 'coaching_id', 'id');
    }
    public function appliedworkinghours()
    {
        return $this->hasMany(NewWorkingHours::class, 'coaching_id', 'id');
    }
    public function appliedachievements()
    {
        return $this->hasMany(NewAchievement::class, 'coaching_id', 'id');
    }
    public function appliedresults()
    {
        return $this->hasMany(NewResult::class, 'coaching_id', 'id');
    }
    public function appliedfaculties()
    {
        return $this->hasMany(NewFacultyStaff::class, 'coaching_id', 'id');
    }
    public function appliedfeestructures()
    {
        return $this->hasMany(NewFeeStructure::class, 'coaching_id', 'id');
    }




    public function newfeeStructures()
    {
        return $this->hasMany(FeeStructure::class, 'coaching_id', 'id');
    }


    public function newresultsAndAchivements()
    {
        return $this->hasMany(ResultAndAchivement::class, 'coaching_id', 'id');
    }

    public function newfaculties()
    {
        return $this->hasMany(FacultyStaff::class, 'coaching_id', 'id');
    }

    public function galleries()
    {
        return $this->hasMany(NewCoachingGallery::class, 'coaching_id', 'id');
    }

    public function newreviews()
    {
        return $this->hasMany(Review::class, 'coaching_id', 'id');
    }

    public function newstats()
    {
        return $this->hasOne(CoachingStatistics::class, 'coaching_id', 'id');
    }
}
