<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Library;
use App\Models\LibraryGallery;
use App\Models\LibraryVideo;
use App\Models\OperationArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\LibFeeStructure;
use App\Models\LibFacilityStructure;

class DashboardLibraryController extends Controller
{
    public function Libraries()
    {
        if (auth()->user()->role == "admin" || auth()->user()->email == "surabhi@taquino.in") {
            $libraries = Library::where('status', 'approved')->orderBy('id', 'desc')->paginate(25);
        } else {
            $libraries = Library::where('status', 'approved')->where('added_by', auth()->user()->id)->orderBy('id', 'desc')->paginate(25);
        }
        return view('dashboard.library.libraries', ['libraries' => $libraries]);
    }

    public function searchLibrary(Request $request)
    {

        if (!$request->search) {
            return redirect("/dashboard/libraries");
        }

        $libraries = Library::where('status', 'approved');

        if (str_contains($request->search, ',')) {
            $search = explode(',', $request->search);
            $libraries->where('name', 'like', '%' . $search[0] . '%');
            $libraries->orWhere('state', 'like', '%' . $search[1] . '%');
        } else {
            $libraries->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%')
                ->orWhere('state', 'like', '%' . $request->search . '%')
                ->orWhere('district', 'like', '%' . $request->search . '%')
                ->orderBy('id', 'desc');
        }

        $libraries = $libraries->get();
        return view('dashboard.library.libraries', ['libraries' => $libraries, "search" => $request->search]);
    }

    public function createLibrary()
    {
        $cities = OperationArea::all();
        return view('dashboard.library.create', ['cities' => $cities]);
    }

    public function insertLibrary(Request $request)
    {
        $remove_aps = str_replace("'", "",$request->input('name'));
        $remove_amp = str_replace("&", "", $remove_aps);
        $remove_slash = str_replace("/", "-", $remove_amp);
        $slug = implode('-', explode(' ', strtolower($remove_slash)));
        $cities = OperationArea::where('id','=',$request->input('cities'))->pluck('name');
        $slug = $slug . '-' . strtolower($cities[0]);

        $updatearr =  [
            'added_by'            => auth()->user()->id,
            'name'                => $request->input('name'),
            'slug'                => $slug,
            'cities'              => $request->input('cities'),
            'email'               => $request->input('email'),
            'phone'               => $request->input('phone'),
            'alternate_phone'     => $request->input('alternate_phone'),
            'address'             => $request->input('address'),
            'landmark'            => $request->input('landmark'),
            'district'            => $request->input('district'),
            'state'               => $request->input('state'),
            'country'             => $request->input('country'),
            'pincode'             => $request->input('pincode'),
            'latitude'            => $request->input('latitude'),
            'longitude'           => $request->input('longitude'),
            'website'             => $request->input('website'),
            'facebook_link'       => $request->input('facebook_link'),
            'youtube_link'        => $request->input('youtube_link'),
            'twitter_link'        => $request->input('twitter_link'),
            'establishment'       => $request->input('establishment'),
            'head_organisation'   => $request->input('head_organisation'),
            'tandc'               => $request->input('tandc'),
            'about'               => $request->input('about'),
            'total_area'          => $request->input('total_area'),
            'fee_structure'       => $request->input('fee_structure'),
            'modes_of_payment'    => implode(",",$request->input('modes_of_payment')),
            'ac_available'        => $request->input('ac_available'),
            'cctv_with_recording' => $request->input('cctv_with_recording'),
            'status'              => 'approved'
        ];

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $path = $logo->store('public/librarylogo');
            $thumb_ext = explode('/', $path);
            $updatearr['logo']  = $thumb_ext[1] . '/' . $thumb_ext[2];
        }

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $path = $thumbnail->store('public/librarythumbnail');
            $thumb_ext = explode('/', $path);
            $updatearr['thumbnail']  = $thumb_ext[1] . '/' . $thumb_ext[2];
        }

        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $path = $video->store('public/libraryvideo');
            $extpath = explode('/', $path);
            $updatearr['video'] = $extpath[1] . '/' . $extpath[2];
        }


        $library = Library::create(
            $updatearr
        );


        if ($request->hasFile('gallery')) {
            $gallery = $request->file('gallery');
            if ($request->hasFile('gallery')) {
                foreach ($gallery as $item) {
                    $path = $item->store('public/librarygallery');
                    $extpath = explode('/', $path);
                    LibraryGallery::create(
                        [
                            'library_id' => $library->id,
                            'image' => $extpath[1] . '/' . $extpath[2]
                        ]
                    );
                }
            }
        }
            
                 $fee_data = $request->only([
            'lib_shift',
            'lib_timing',
            'lib_monthly_fee'
        ]);

        $this->add_Fee_Structure($fee_data, $library->id);


        $facility_data = $request->only([
            'lib_facility',
        ]);

        $this->add_Facility_Structure($facility_data, $library->id);


        return redirect('dashboard/libraries');
    }


    public function editLibrary($id)
    {
        $library = Library::find($id);
        $cities = OperationArea::all();
        Session::put('redirected_from', $_SERVER['HTTP_REFERER']);
        return view('dashboard.library.edit', ['library' => $library, 'cities' => $cities ]);
    }

    public function updateLibrary(Request $request)
    {
        $cities = OperationArea::find($request->input('cities'));
        $remove_aps = str_replace("'", "", $request->input('name'));
        $remove_amp = str_replace("&", "", $remove_aps);
        $remove_slash = str_replace("/", "-", $remove_amp);
        $slug = implode('-', explode(' ', strtolower($remove_slash)));
        $cities = OperationArea::where('id', '=' ,$request->input('cities'))->pluck('name');
        $slug = $slug . '-' . strtolower($cities[0]);

        $cities = OperationArea::find($request->input('cities'));
        $updatearr =  [
            'name'                => $request->input('name'),
            'slug'                => $slug,
            'cities'              => $request->input('cities'),
            'email'               => $request->input('email'),
            'phone'               => $request->input('phone'),
            'alternate_phone'     => $request->input('alternate_phone'),
            'address'             => $request->input('address'),
            'landmark'            => $request->input('landmark'),
            'district'            => $request->input('district'),
            'state'               => $request->input('state'),
            'country'             => $request->input('country'),
            'pincode'             => $request->input('pincode'),
            'latitude'            => $request->input('latitude'),
            'longitude'           => $request->input('longitude'),
            'website'             => $request->input('website'),
            'facebook_link'       => $request->input('facebook_link'),
            'youtube_link'        => $request->input('youtube_link'),
            'twitter_link'        => $request->input('twitter_link'),
            'establishment'       => $request->input('establishment'),
            'head_organisation'   => $request->input('head_organisation'),
            'tandc'               => $request->input('tandc'),
            'about'               => $request->input('about'),
            'total_area'          => $request->input('total_area'),
            'fee_structure'       => $request->input('fee_structure'),
            'modes_of_payment'    => implode(",",$request->input('modes_of_payment')),
            'ac_available'        => $request->input('ac_available'),
            'cctv_with_recording' => $request->input('cctv_with_recording'),
            'status'              => 'approved',
        ];

        if ($request->hasFile('logo')) {
            $logo               = $request->file('logo');
            $path               = $logo->store('public/librarylogo');
            $thumb_ext          = explode('/', $path);
            $updatearr['logo']  = $thumb_ext[1] . '/' . $thumb_ext[2];
        }

        if ($request->hasFile('thumbnail')) {
            $thumbnail               = $request->file('thumbnail');
            $path                    = $thumbnail->store('public/librarythumbnail');
            $thumb_ext               = explode('/', $path);
            $updatearr['thumbnail']  = $thumb_ext[1] . '/' . $thumb_ext[2];
        }

        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $path = $video->store('public/libraryvideo');
            $extpath = explode('/', $path);
            $updatearr['video'] = $extpath[1] . '/' . $extpath[2];
        }


        if ($request->hasFile('gallery')) {
            $gallery = $request->file('gallery');
            $galarr = array();
            if ($request->hasFile('gallery')) {
                foreach ($gallery as $item) {
                    $path = $item->store('public/librarygallery');
                    $extpath = explode('/', $path);
                    $img = $extpath[1] . '/' . $extpath[2];
                    $check = LibraryGallery::where('library_id', $request->id)->where('image', $img)->get();
                    if ($check->count() == 0) {
                        LibraryGallery::create(
                            [
                                'library_id' => $request->id,
                                'image' => $img
                            ]
                        );
                    }
                }
            }
        }

        Library::find($request->input("id"))->update(
            $updatearr
        );
        $fee_data = $request->only([
            'lib_shift',
            'lib_timing',
            'lib_monthly_fee',

        ]);

        $this->add_Fee_Structure($fee_data, $request->input('id'));
        $facility_data = $request->only([
            'lib_facility',

        ]);

        $this->add_Facility_Structure($facility_data, $request->input('id'));


        return redirect(session('redirected_from'))->with('message', 'Library updated successfully.');
    }

    public function deleteLibraryGalleryImage($id)
    {
        $img = LibraryGallery::find($id);
        try {
            unlink(public_path('storage') . '/' . $img->image);
        } catch (\Throwable $th) {
        }
        LibraryGallery::find($id)->delete();
        return redirect()->back()->with('message', 'Gallery image deleted successfully');
    }

    public function deleteLibrary($id)
    {
        $library = Library::find($id);

        if (!in_array(auth()->user()->role, ['admin', 'executive'])) {
            if (auth()->user()->id != $library->added_by) {
                return  redirect()->back()->with('message', 'You cannot delete entry of other person. Please contact admin');
            }
        }

        try {
            unlink(public_path('storage') . '/' . $library->logo);
            unlink(public_path('storage') . '/' . $library->thumbnail);
            foreach (json_decode($library->gallery) as $img) {
                unlink(public_path('storage') . '/' . $img);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
        Library::find($id)->delete();
        return redirect()->back()->with('message', 'Library deleted successfully.');
    }

public function add_Fee_Structure($data, $library_id)
    {   LibFeeStructure::where('library_id', $library_id)->delete();

        foreach ($data['lib_shift'] as $key => $value) {

                LibFeeStructure::create(
                    [
                        'library_id' => $library_id,

                        'lib_shift' => $data['lib_shift'][$key],
                        'lib_timing' => $data['lib_timing'][$key],
                        'lib_monthly_fee' => $data['lib_monthly_fee'][$key],

                    ]
                );
                // }
            }
            // }

    }
    public function add_Facility_Structure($data, $library_id)
    {   LibFacilityStructure::where('library_id', $library_id)->delete();

        foreach ($data['lib_facility'] as $key => $value) {

            
                LibFacilityStructure::create(
                    [
                        'library_id' => $library_id,

                        'facility' => $data['lib_facility'][$key],

                    ]
                );
                // }
            }
            // }

    }


}
