<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerChangePassRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "old_password" => "required",
            "new_password" => "required|min:8",
            "password_confirmation" => "required|same:new_password",
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!Hash::check($this->old_password, Auth::user()->password)) {
                $validator->errors()->add('old_password', 'Mật khẩu cũ không đúng.');
            }
        });
    }
}
