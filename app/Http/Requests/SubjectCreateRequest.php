<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => "required|unique:subjects,name",
            "description" => "required",
            "image" => "required|mimes:jpg,jpeg,webp,png",
        ];
    }
}
