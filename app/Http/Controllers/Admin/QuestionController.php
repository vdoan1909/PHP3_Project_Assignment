<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionCreateRequest;
use App\Imports\QuestionImport;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class QuestionController extends Controller
{
    const PATH_VIEW = "admin.question.";
    const PATH_UPLOAD = "question";

    public function index()
    {
        $data = Question::latest("id")->with("exam")->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact("data"));
    }

    public function import()
    {
        $exams = Exam::get();
        return view(self::PATH_VIEW . __FUNCTION__, compact("exams"));
    }

    public function file(QuestionCreateRequest $request)
    {
        $exam_id = $request->exam_id;
        $is_create = Excel::import(new QuestionImport($exam_id), $request->file('import_file'));

        if ($is_create) {
            return redirect()->route("admin.questions.index")->with("success", "Import data question successfully");
        }
    }

    public function edit(Question $question)
    {
        $question = $question->load('exam');
        $exam = Exam::get();
        return view(self::PATH_VIEW . __FUNCTION__, compact("question", "exam"));
    }

    public function update(Request $request, Question $question)
    {
        $data = $request->all();

        $request->validate(
            [
                "name" => "required",
                "exam_id" => "required",
                "option_a" => "required",
                "option_b" => "required",
                "option_c" => "required",
                "option_d" => "required",
                "correct_answer" => "required"
            ]
        );

        $question->update($data);

        return redirect()->route("admin.questions.index")->with("success", "Edit question successfully");
    }

    public function destroy(Question $question)
    {
        //
    }
}
