<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request){
        ContactMessage::create(
            [
                'name'=>$request->uname,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'message'=>$request->message
            ]
        );

        return redirect()->back()->with('message','Your message has been submitted successfully.');
    }
}
