<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($data, $http_status = 200){
            $respuesta = [
                "success" => true,
                "data" => $data,
            ];
            return response()->json( $respuesta , $http_status);
    }

    /* Response de error */
    public function sendError($errors, $http_status = 404){
        $respuesta = [
            "success" => false,
            "errors" => $errors,
        ];
        return response()->json( $respuesta , $http_status);
    }
}
