<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class RecruteurRequest extends FormRequest
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
            'imageURL' => ['sometimes', 'required', 'image', 'mimes:jpeg,jpg,png,gif'],
            'ville' => ['sometimes', 'required', 'string', 'max:255'],
            'telephone' => ['sometimes', 'required', 'string', 'max:255'],
            'poste' => ['sometimes', 'required', 'string', 'max:255'],
            'nom' => ["sometimes", 'required', "string", "max:255"],
            'dateCreation' => ['sometimes', 'required', 'date'],
            'nombreEmployees' => ['sometimes', 'required', 'integer', 'min:0'],
            'description' => ["sometimes", "required", "string", "max:255"],
            'domaine' => ["sometimes", "required", "array"],
            'domaine.*' => ["exists:domaines,id"],
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
