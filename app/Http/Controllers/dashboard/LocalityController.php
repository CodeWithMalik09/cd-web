<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\OperationArea;
use App\Models\Locality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class LocalityController extends Controller
{
    public function localities(){
        $localities = Locality::paginate(25);
        $cities     = OperationArea::all();
        return view('dashboard.localities',['localities'=>$localities,'cities'=>$cities]);
    }

    public function createLocality(Request $request){
        Locality::create([
            'name'=>$request->input('localityname'),
            'city'=>$request->input('city')
        ]);
        return redirect('dashboard/localities');
    }

    public function searchLocality(Request $request)
    {

        if (!$request->search) {
            return redirect("/dashboard/localities");
        }

        if (str_contains($request->search, ',')) {
            $search = explode(',', $request->search);
            $localities = Locality::where('name', 'like', '%' . $search[0] . '%');
        } else {
            $localities = Locality::where('name', 'like', '%' . $request->search . '%');
        }

        $localities = $localities->get();
        $cities = OperationArea::all();
        return view('dashboard.localities',['localities'=>$localities,'cities'=>$cities,"search" => $request->search]);

    }

    public function deleteLocality($id){
        Locality::find($id)->delete();
        // return redirect('dashboard/localities');
        return redirect('dashboard/localities')->with('message', 'Locality deleted successfully.');

    }

}
