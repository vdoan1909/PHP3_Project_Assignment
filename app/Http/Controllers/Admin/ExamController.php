<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamCreateRequest;
use App\Http\Requests\ExamUpdateRequest;
use App\Models\Exam;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

    public function store(ExamCreateRequest $request)
    {
        $data = $request->all();

        $rann = range('A', 'Z');
        $randomCharacters = '';
        for ($i = 0; $i < 5; $i++) {
            $randomCharacters .= $rann[array_rand($rann)];
        }
        $data["slug"] = Str::slug($data["name"]) . "-" . $randomCharacters;

        $is_create = Exam::create($data);

        if ($is_create) {
            Log::channel('customer')->info(Auth::user()->name . " đã thêm bài kiểm tra: " . $data["name"]);
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

    public function update(ExamUpdateRequest $request, string $slug)
    {

        $exam = Exam::where("slug", $slug)->firstOrFail();
        $currentNameExam = $exam->name;

        $data = $request->all();

        if ($data["name"]) {
            $rann = range('A', 'Z');
            $randomCharacters = '';
            for ($i = 0; $i < 5; $i++) {
                $randomCharacters .= $rann[array_rand($rann)];
            }
            $data["slug"] = Str::slug($data["name"]) . "-" . $randomCharacters;
        }

        $exam->update($data);
        Log::channel('customer')->info(Auth::user()->name . " đã sửa bài kiểm tra: " . $currentNameExam);

        return redirect()->route("admin.exams.index")->with("success", "Edit exam successfully");
    }

    public function destroy(string $slug)
    {
        $exam = Exam::where("slug", $slug)->firstOrFail();
        Log::channel('customer')->info(Auth::user()->name . " đã xóa bài kiểm tra: " . $exam->name);
        $exam->delete();

        return redirect()->route("admin.exams.index")->with("success", "Delete exam successfully");
    }
}
