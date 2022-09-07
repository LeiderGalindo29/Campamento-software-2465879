<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BootcampController;
use App\Http\Controllers\CourseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('prueba', function(){
    echo "Hola";
});


//Ruta de rest para la gestion de estado de los bootscamp

Route::apiResource('bootcamps', BootcampController::class);
Route::apiResource('courses', CourseController::class);
Route::post('course/{idbootcamp}/create',[CourseController::class , "store"]);