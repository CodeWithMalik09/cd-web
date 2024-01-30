<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentRegistrationDetail;

class DashboardEnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = StudentRegistrationDetail::all();
        return view('dashboard.enrollment.index', ['enrollments' => $enrollments]);
    }
   public function verify($id)
    {
        $studentRegistration = StudentRegistrationDetail::find($id);
    
        if ($studentRegistration) {
            $studentRegistration->update(['verification_status' => 1]);
    
           return redirect()->back()->with('message', 'verification approved');
        }
    
        return response()->json(['error' => 'Record not found'], 404);
    }

    public function unverify($id)
    {
        $studentRegistration = StudentRegistrationDetail::find($id);
    
        if ($studentRegistration) {
            $studentRegistration->update(['verification_status' => 0]);
    
            return redirect()->back()->with('message', 'verification removed');

        }
    
        return response()->json(['error' => 'Record not found'], 404);
    }

    public function show($id){

    }

    public function edit($id){

    }

    public function delete($id){
        
    }
}
