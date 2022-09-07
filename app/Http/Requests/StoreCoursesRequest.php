<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreCoursesRequest extends FormRequest
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
            "text" => 'required|min:10|max:30',
            "description" => 'required|min:10',
            "weeks" => 'required|max:9',
            "enroll_cost" => 'required|numeric',
            "minimum_skill" => 'required|in:Beginner,Intermediate,Advanced,Expert'
        ];
    }
    public function messages(){
        return[ 
            "text" => 'Texto requerido',
            "description" => 'descripcion requerida',
            "weeks" => 'maximo 9 caracteres',
            "enroll_cost" => 'solo numeros',
            "minimum_skill" => 'Only Beginner, Intermediate, Advanced, Expert'
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

