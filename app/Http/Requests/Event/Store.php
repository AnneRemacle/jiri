<?php

namespace Jiri\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            "course_name" => "required",
            "academic_year" => "required",
            "exam_session" => "required",
            "user_id" => "required"
        ];
    }

    public function messages() {
        return [
            "course_name.required" => "Veuillez indiquer le nom du cours",
            "academic_year.required" => "Veuillez entrer une année académique",
            "exam_session.required" => "Veuillez choisir la session concernée",
            "user_id.required" => "Veuillez choisir un professeur responsable"
        ];
    }
}
