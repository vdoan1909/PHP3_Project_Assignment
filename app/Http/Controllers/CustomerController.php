<?php

namespace App\Http\Controllers;

use App\Models\UserExam;
use App\Models\UserSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    const PATH_VIEW = "client.customer.";

    public function show()
    {
        $get_user_exam = UserExam::with("exam")
        ->where("user_id", Auth::User()->id)
        ->get();

        $get_user_subject = UserSubject::with("subject")
        ->where("user_id", Auth::User()->id)
        ->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact("get_user_exam", "get_user_subject"));
    }
}
