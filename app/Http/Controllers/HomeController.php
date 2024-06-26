<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Exam;
use App\Models\UserExam;
use App\Models\UserSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('client.index');
    }
}
