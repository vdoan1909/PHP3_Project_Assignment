<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => "required|unique:exams,name",
            "time_limit" => "required|numeric",
            "number_of_questions" => "required|numeric",
            "subject_id" => "required",
            "description" => "required"
        ];
    }
}
