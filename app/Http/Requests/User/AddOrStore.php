<?php

namespace Jiri\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AddOrStore extends FormRequest
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
             "email" => "required|email"
         ];
     }

     public function messages()
     {
         return [
             'email.required'  => 'L’email est obligatoire',
             'email.email' => 'Veuillez introduire une adresse email valide'
         ];
     }
}
