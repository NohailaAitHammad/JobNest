<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class ProfileCandidatRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "firstName" => ["sometimes", "required", "string", "max:255"],
            "lastName"   => ["sometimes", "required", "string", "max:255"],
            "email"      => ["sometimes", "required", "email", "unique:users,email," . Auth::id()],

            "imageURL" => ["sometimes","required", "image", "mimes:jpeg,jpg,png,gif"],
            "ville" => ["sometimes", "required", "string", "max:255"],
            "telephone" => ["sometimes", "required", "string", "max:255"],
            "cv_url" => ["sometimes", "required", "file","mimes:pdf", "max:2048"],
            "portfolio_url" => ["sometimes", "required", "file","mimes:pdf", "max:2048"],
            "est_visible" => ["sometimes", "required"]
        ];
    }

    protected function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(
            redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput()
        );
    }
}
