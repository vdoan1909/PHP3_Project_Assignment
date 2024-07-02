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
        if ($request->name) {
            $subjects = Subject::where("name", "like", "%" . $request->name . "%")->get();
        } else {
            $subjects = Subject::latest("id")->take(6)->get();
        }
        $count_res = UserSubject::selectRaw('subject_id, COUNT(user_id) as total')
            ->groupBy('subject_id')
            ->get();
        return view('client.index', compact("subjects", "count_res"));
    }

    public function menu(Request $request)
    {
        if ($request->name) {
            $subjects = Subject::where("name", "like", "%" . $request->name . "%")->get();
        } else {
            $subjects = Subject::latest("id")->get();
        }
        return view('client.subject.list', compact("subjects"));
    }

    public function exams(Request $request)
    {
        $id_user = null;
        $get_user_subject = [];
        $get_user_exam = [];

        if (Auth::Check()) {
            $id_user = Auth::User()->id;
        }

        $subjects = Subject::latest("id")->get();

        if ($request->name) {
            $exams = Exam::where("name", "like", "%" . $request->name . "%")->with("subject")->get();
        } else {
            $exams = Exam::latest("id")->with("subject")->get();
        }

        $get_user_subject = UserSubject::where('user_id', $id_user)->get()->keyBy('subject_id');
        $get_user_exam = UserExam::where('user_id', $id_user)->get()->keyBy('exam_id');

        return view("client.exam.list", compact("subjects", "exams", "get_user_subject", "get_user_exam"));
    }

    public function examBySubject(Request $request)
    {
        $id_user = null;

        if (Auth::Check()) {
            $id_user = Auth::User()->id;
        }

        $subject = Subject::where("slug", $request->slug)->with("exams")->firstOrFail();

        $get_user_subject = UserSubject::where("user_id", $id_user)
            ->where("subject_id", $subject->id)
            ->get();

        $get_user_exam = UserExam::where("user_id", $id_user)
            ->get()
            ->keyBy("exam_id");

        return view("client.exam.examBySubject", compact("subject", "get_user_subject", "get_user_exam"));
    }

    public function startQuizz(Request $request)
    {
        $currentDate = Carbon::now("Asia/Ho_Chi_Minh")->format('d/m/Y');
        $exam = Exam::where("slug", $request->slug)->with("questions")->firstOrFail();
        $exam->questions = $exam->questions->shuffle();
        return view("client.exam.startQuizz", compact("exam", "currentDate"));
    }

    public function finallyQuizz(Request $request)
    {
        $data = $request->all();

        $exam = Exam::where("slug", $request->slug)->with("questions")->firstOrFail();
        $questions = $exam->questions;
        $user_answer = $data["answers"];

        // kiem tra key cua user_answer == questions && value cua user_answer == value cua questions ==> tra loi dung
        $score = 0;

        foreach ($questions as $question) {
            if (array_key_exists($question->id, $user_answer)) {
                if ($user_answer[$question->id] == $question->correct_answer) {
                    $score++;
                }
            }
        }

        $score = $score / $exam->number_of_questions * 10;

        $get_user_exam = UserExam::where("user_id", $data["user_id"])
            ->where("exam_id", $exam->id)
            ->first();

        if (!$get_user_exam) {
            UserExam::create(
                [
                    "user_id" => $data["user_id"],
                    "exam_id" => $exam->id,
                    "score" => $score,
                ]
            );
        } else {
            UserExam::where("user_id", $data["user_id"])
                ->where("exam_id", $exam->id)
                ->update(
                    [
                        "user_id" => $data["user_id"],
                        "exam_id" => $exam->id,
                        "score" => $score,
                    ]
                );
        }

        return redirect()->route("client.exams.result")->with(
            [
                "exam" => $exam->id,
                "score" => $score
            ]
        );
    }

    public function result(Request $request)
    {
        $exam = Exam::findOrFail(session("exam"));
        $score = session("score");
        $currentDate = Carbon::now("Asia/Ho_Chi_Minh")->format('d/m/Y');

        return view("client.exam.result", compact("exam", "score", "currentDate"));
    }
}