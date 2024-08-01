<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CustomerUpdateRequest extends FormRequest
{
    public $customer_id;

    protected function prepareForValidation()
    {
        $customer = User::where("id", Auth::id())->first();
        $this->customer_id = $customer ? $customer->id : null;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->customer_id,
        ];
    }
}
