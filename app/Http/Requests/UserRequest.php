<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => 'required|string|max:255',
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:'.User::class,
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()->min(6)],
            'password' => ['required', 'confirmed', Password::defaults()->min(6)],
        ];
    }
}
