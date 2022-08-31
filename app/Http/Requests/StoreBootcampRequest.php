<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreBootcampRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => 'required|min:5',
            "description" => 'required',
            "website" => 'required|URL',
            "phone" => 'required|numeric',
            "user_id" => 'required|exists:users,id'
        ];
    }
    public function messages(){
        return[ 
        'name.required' => 'Nombre Requerido.',
        'name.min' =>'El nombre no puede ser menor a :max caracteres.',
        'description.required' => 'descripcion requerida.',
        'website.required' => 'website requerida.',
        'website.url' => 'la url de la website es requerida.',
        'phone.required' => 'telefono requerida.',
        'phone.numeric' => 'La puntuación debe ser un número',
        ];
    }
    //agregar metodo para enviar respuesta con errores de validacion
    protected function failedValidation(Validator $v){
        //Si la  validacion falla se lanza una excepcion http
        throw new HttpResponseException( 
            response()->json(["success"=> false,
            "erros" => $v->errors()
        ], 422 )
        );
    }
}

