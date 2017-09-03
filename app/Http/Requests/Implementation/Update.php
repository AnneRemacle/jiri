<?php

namespace Jiri\Http\Requests\Implementation;

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
            "results.*.*.url_repo" => "nullable|url",
            "results.*.*.url_project" => "nullable|url"
        ];
    }

    public function messages(){
        return [
            "results.*.*.url_repo.url" => "L'adresse du repo doit être une url valide",
            "results.*.*.url_project.url" => "L'adresse du projet doit être une url valide"
        ];
    }
}
