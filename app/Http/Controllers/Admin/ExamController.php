<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExamController extends Controller
{
    const PATH_VIEW = "admin.exam.";
    const PATH_UPLOAD = "exams";

    public function index()
    {
        $data = Exam::latest("id")->with("subject")->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact("data"));
    }

    public function create()
    {
        $subjects = Subject::get();
        return view(self::PATH_VIEW . __FUNCTION__, compact("subjects"));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $rann = range('A', 'Z');
        $randomCharacters = '';
        for ($i = 0; $i < 5; $i++) {
            $randomCharacters .= $rann[array_rand($rann)];
        }
        $data["slug"] = Str::slug($data["name"]) . "-" . $randomCharacters;

        $request->validate(
            [
                "name" => "required|unique:exams,name",
                "time_limit" => "required|numeric",
                "number_of_questions" => "required|numeric",
                "subject_id" => "required",
                "description" => "required"
            ]
        );

        $is_create = Exam::create($data);

        if ($is_create) {
            return redirect()->route("admin.exams.index")->with("success", "Create a new exam successfully");
        } else {
            return redirect()->route("admin.exams.index")->with("error", "Create a new exam failed");
        }
    }

    public function edit(string $slug)
    {
        $exam = Exam::where("slug", $slug)->firstOrFail();
        $subjects = Subject::get();
        return view(self::PATH_VIEW . __FUNCTION__, compact("exam", "subjects"));
    }

    public function update(Request $request, string $slug)
    {
        $exam = Exam::where("slug", $slug)->firstOrFail();
        $data = $request->all();
        
        if ($data["name"]) {
            $rann = range('A', 'Z');
            $randomCharacters = '';
            for ($i = 0; $i < 5; $i++) {
                $randomCharacters .= $rann[array_rand($rann)];
            }
            $data["slug"] = Str::slug($data["name"]) . "-" . $randomCharacters;
        }

        $request->validate(
            [
                "name" => "required|unique:exams,name," . $exam->id,
                "time_limit" => "required|numeric",
                "number_of_questions" => "required|numeric",
                "subject_id" => "required",
                "description" => "required"
            ]
        );

        $exam->update($data);

        return redirect()->route("admin.exams.index")->with("success", "Edit exam successfully");
    }

    public function destroy(string $slug)
    {
        $exam = Exam::where("slug", $slug)->firstOrFail();
        $exam->delete();    

        return redirect()->route("admin.exams.index")->with("success", "Delete exam successfully");
    }
}
