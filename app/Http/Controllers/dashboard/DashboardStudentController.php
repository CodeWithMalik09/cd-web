<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\StudentRegistrationDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardStudentController extends Controller
{
    public function Students()
    {
        $students = User::where('role','=','student')->orderBy('id', 'desc')->paginate(25);
        return view('dashboard.student.students', ['students' => $students]);
    }

   public function lateststudents()
    {
        $students = User::where('role', '=', 'student')

    ->orderBy('latest_login_time', 'desc')

    ->paginate(25);

        return view('dashboard.student.latest_loggedin_students', ['students' => $students]);
    }

    public function enrollments($id){
        $enrollments = StudentRegistrationDetail::where('user_id',$id)->orderBy('id', 'desc')->paginate(25);
        return view('dashboard.student.enrollments',['enrollments'=>$enrollments]);
    }
}
