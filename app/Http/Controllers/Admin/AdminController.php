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
        $count_user_exam = [];

        $count_subject = Subject::count("id");
        $count_exam = Exam::count("id");
        $count_customer = User::where("role", "member")
            ->count("id");

        $subjects = Subject::latest("id")->get();
        $exams = Exam::latest("id")->with("subject")->get();

        $count_res = UserSubject::selectRaw('subject_id, COUNT(user_id) as total')
            ->groupBy('subject_id')
            ->get();

        $count_subject_exam = Subject::withCount('exams')->get();

        foreach ($exams as $exam) {
            $count_user_exam[$exam->id] = UserExam::where("exam_id", $exam->id)
                ->count("user_id");
        }

        return view(
            self::PATH_VIEW . __FUNCTION__,
            compact(
                "count_subject",
                "count_exam",
                "count_customer",
                "subjects",
                "count_res",
                "count_subject_exam",
                "exams",
                "count_user_exam",
            )
        );
    }
}
