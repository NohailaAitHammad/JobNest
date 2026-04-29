<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Validator;

class ExperienceRequest extends FormRequest
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
            "poste" => ['sometimes', 'required', 'string', 'max:255'],
            "entreprise" => ['sometimes', 'required', 'string', 'max:255'],
            "description" => ['sometimes', 'required', 'string', 'max:255'],
            "dateDebut" => ['sometimes','required', 'date'],
            "dateFin" => ['sometimes', 'required', 'date', 'after:dateDebut']
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
