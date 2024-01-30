<?php

namespace App\Http\Controllers\api\app\library;

use App\Http\Controllers\Controller;
use App\Models\Library;
use App\Models\OperationArea;
use Illuminate\Http\Request;

class AppLibraryController extends Controller
{
    public function getCities()
    {
        $cities =  OperationArea::select(['id', 'name'])->get();
        return response()->json(['status' => "true",'message' => ['success'], 'cities' => $cities], 200);
    }


    public function library(Request $request)
    {
        $library = Library::where('id', $request->input('library_id'))->get()->first();
        $gallery = array();
        if ($library->galleries) {
            foreach ($library->galleries as $gallery_item) {
                array_push($gallery, url('storage') . '/' . $gallery_item->image);
            }
        }
        $library->{'pgallery'} = $gallery;
        unset($library->gallery);
        return response()->json(['status' => "true",'message' => ['success'], 'library' => $library], 200);
    }

    public function recentlyAddedLibrary(Request $request)
    {
        $libraries = Library::orderBy("id", "DESC")
            ->where('status', 'approved')
            ->limit(6)
            ->get();

        foreach ($libraries as $library) {
            $library->{'logo'} = url('storage') . '/' . $library->logo;
        }
        return response()->json(['status' => "true",'message' => ['success'], 'libraries' => $libraries], 200);
    }

    public function searchLibrary(Request $request)
    {
        $libraries = Library::orderBy("id", "DESC")
            ->offset(10 * $request->input('offset'))
            ->where('status', 'approved')
            ->where('cities', $request->city_id)
            ->limit(10)
            ->get();

        foreach ($libraries as $library) {
            $library->{'logo'} = url('storage') . '/' . $library->logo;
        }
        return response()->json(['status' => "true",'message' => ['success'], 'libraries' => $libraries], 200);
    }


    public function mapSearchLibrary(Request $request)
    {
        $libraries = Library::orderBy("id", "DESC")
            ->offset(10 * $request->input('offset'))
            ->where('status', 'approved')
            ->where('cities', $request->city_id)
            ->where('latitude', '<>', null)
            ->where('longitude', '<>', null)
            ->select(['id', 'latitude', 'longitude'])
            ->limit(10)
            ->get();
        return response()->json(['status' => "true",'message' => ['success'], 'libraries' => $libraries], 200);
    }
}
