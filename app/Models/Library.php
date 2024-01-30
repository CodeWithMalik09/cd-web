<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    // use HasFactory;

    protected $fillable = [
        'added_by',
        'name',
        'slug',
        'cities',
        'email',
        'phone',
        'alternate_phone',
        'address',
        'landmark',
        'district',
        'state',
        'country',
        'pincode',
        'latitude',
        'longitude',

        'website',
        'facebook_link',
        'youtube_link',
        'twitter_link',

        'establishment',
        'total_branches',
        'head_organisation',
        'tandc',
        'about',
        'total_area',

        'fee_structure',
        'modes_of_payment',

        'ac_available',
        'cctv_with_recording',

        'logo',
        'thumbnail',
        'gallery',
        'video',
        'password',
        'updated_at',

        'status',
        'is_active',
        'is_deleted'
    ];
   public function lib_fee_structures()
    {
        return $this->hasMany(LibFeeStructure::class, 'library_id', 'id');
    }

    public function lib_facility_structures()
    {
        return $this->hasMany(LibFacilityStructure::class, 'library_id', 'id');
    }

    public function galleries()
    {
        return $this->hasMany(LibraryGallery::class, 'library_id', 'id');
    }
}
