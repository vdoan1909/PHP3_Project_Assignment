<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Subject;
use App\Models\UserExam;
use App\Models\UserSubject;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    const PATH_VIEW = "admin.";
    public function index()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }
}
