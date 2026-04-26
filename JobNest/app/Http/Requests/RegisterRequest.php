<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstName' => ['required', 'string', 'min:3'],
            'lastName' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6', 'confirmed'],
        ];
    }
    public function messages()
    {
        return [
            'firstName' => 'First Name is required',
            'lastName' => 'Last Name is required',
            'email.unique' => "L'adresse email est déjà utilisée.",
            'password:min' => "Le mot de passe doit contenir au moins 8 caractères."
        ];
    }
}
