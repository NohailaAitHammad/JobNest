<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
            "imageURL" => ["sometimes","required", "image", "mimes:jpeg,jpg,png,gif"],
            "ville" => ["sometimes", "required", "string", "max:255"],
            "telephone" => ["sometimes", "required", "string", "max:255"],
            "cv_url" => ["sometimes", "required", "file","mimes:pdf", "max:2048"],
            "portfolio_url" => ["sometimes", "required", "file","mimes:pdf", "max:2048"],
            "est_visible" => ["sometimes", "required"]
        ];
    }
}
