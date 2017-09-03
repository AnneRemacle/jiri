<?php

namespace Jiri\Http\Requests\Student;

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

     public function rules()
     {
         return [
             "name" => "required",
             "email" => "required|email"
         ];
     }

     public function messages()
     {
         return [
             "name.required" => "Veuillez entrer un nom",
             'email.required'  => 'L’email est obligatoire',
             'email.email' => 'Veuillez introduire une adresse email valide'
         ];
     }
}
