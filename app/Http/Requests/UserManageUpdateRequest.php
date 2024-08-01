<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserManageUpdateRequest extends FormRequest
{
    public $user_manage_id;

    public function prepareForValidation()
    {
        if ($this->route("id")) {
            $user_manage = User::where("id", $this->route("id"))->first();
            $this->user_manage_id = $user_manage ? $user_manage->id : null;
        }
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->user_manage_id,
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|min:8|same:password',
        ];
    }
}
