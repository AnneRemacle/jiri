<?php

namespace Jiri\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "results.*.name" => "required",
            "results.*.weight" => "required|numeric"
        ];
    }

    public function messages()
    {
        return [
            'results.*.name.required' => 'Le nom est obligatoire',
            'results.*.weight.numeric'  => 'La pondération doit être un chiffre',
            'results.*.weight.required' => 'La pondération est obligatoire'
        ];
    }
}
