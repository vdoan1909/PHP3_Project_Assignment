<?php

namespace App\Http\Requests;

use App\Models\Exam;
use Illuminate\Foundation\Http\FormRequest;

class ExamUpdateRequest extends FormRequest
{
    public $exam_id;

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if ($this->route('slug')) {
            $exam = Exam::where('slug', $this->route('slug'))->first();
            $this->exam_id = $exam ? $exam->id : null;
        }
    }

    public function rules(): array
    {
        return [
            "name" => "required|unique:exams,name," . $this->exam_id,
            "time_limit" => "required|numeric",
            "number_of_questions" => "required|numeric",
            "subject_id" => "required",
            "description" => "required"
        ];
    }
}
