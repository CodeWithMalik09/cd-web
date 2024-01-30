<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\OperationArea;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function cities(){
        $cities = OperationArea::all();
        return view('dashboard.cities',['cities'=>$cities]);
    }

    public function createCity(Request $request){
        OperationArea::create([
            'name'=>$request->input('cityname')
        ]);
        return redirect('dashboard/cities');
    }

    public function deleteCity($id){
        OperationArea::find($id)->delete();
        return redirect('dashboard/cities');
    }

}
