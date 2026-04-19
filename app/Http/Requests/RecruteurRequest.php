<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
            'imageURL' => ['sometimes', 'required', 'string', 'max:255'],
            'ville' => ['sometimes', 'required', 'string', 'max:255'],
            'telephone' => ['sometimes', 'required', 'string', 'max:255'],
            'poste' => ['sometimes', 'required', 'string', 'max:255'],
            //'entreprise' => ['sometimes', 'required', 'string', 'max:255'],
            'nom' => ["sometimes", 'required', "string", "max:255"],
            "dateCreation" => ['sometimes', 'required', 'date'],
            "nombreEmployees" => ['sometimes', 'required', 'int', 'min:0'],
            "description" => ["sometimes", "required", "string", "max:255"],
            "domaine" => ["sometimes", "required", "array"],
            "domaine.*" => ["exists:domaines,id"]
        ];
    }
}
