<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CMSUserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'operator')->get();
        return view('dashboard.user.cmsusers', ['users' => $users]);
    }

    public function cmsUserView($id)
    {
        $user = User::find($id);
        // dd($user);
        // Session::put('admin',$user);
        Auth::login($user);
        // echo "<script>window.open('".url('dashboard')."', '_blank','scrollbars=yes')</script>";
        return redirect()->to('dashboard');
    }

    public function newCMSUser()
    {
        return view('dashboard.user.cmsnewuser');
    }

    public function storeCMSUser(Request $request)
    {
        User::create(
            [
                'name' => $request->username,
                'username' => uniqid(),
                'phone' => $request->phone,
                'email' => $request->email,
                'password'=>md5($request->password),
                'role'=>"operator"
            ]
        );

        return redirect('dashboard/cms-users')->with('message','CMS user added successfully.');
    }

    public function changeUserRole($id){
        User::find($id)->update(
            [
                'role'=>'student'
            ]
        );
        return redirect('dashboard/cms-users')->with('message','CMS user role changed successfully.');
    }

    public function editCMSUser($id){
        $user = User::find($id);
        return view('dashboard.user.cmsuseredit', ['user' => $user]);
    }

    public function CMSUserUpdate(Request $request){
        $data = [
            'name'=>$request->username,
            'email'=>$request->email,
            'phone'=>$request->phone
        ];

        if($request->has('password')){
            $data['password'] = md5($request->password);
        }

        User::find($request->userid)->update($data);

        return redirect('dashboard/cms-users')->with('message','CMS user updated successfully.');
    }
}
