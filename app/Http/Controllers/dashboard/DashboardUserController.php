<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    public function index(){
        $users = User::where([['role','!=','employee'],['role','!=','admin']])->get();
        return view('dashboard.user.index',['users'=>$users]);
    }

    public function delete($id){
        User::find($id)->delete();
        return redirect('dashboard/siteusers')->with('message','User deleted successfully.');
    }

}
