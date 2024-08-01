<?php

namespace App\Http\Requests;

use App\Models\Subject;
use Illuminate\Foundation\Http\FormRequest;

class SubjectUpdateRequest extends FormRequest
{
    public $subject_id;

    public function prepareForValidation()
    {
        if ($this->route("slug")) {
            $subject = Subject::where("slug", $this->route("slug"))->first();
            $this->subject_id = $subject ? $subject->id : null;
        }
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => "required|unique:subjects,name," . $this->subject_id,
            "description" => "required",
            "image" => "mimes:jpg,jpeg,webp,png",
        ];
    }
}
