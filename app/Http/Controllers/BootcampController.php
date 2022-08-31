<?php

namespace App\Http\Controllers;
use App\Models\Bootcamp;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBootcampRequest;
use App\Http\Resources\BootcampCollection;
use App\Http\Resources\BootcampResource;
class BootcampController extends Controller
{   
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //echo "mostrar todos los bootcamp";
        //json es un metodo q trae los datos del response
        //parametros, data a enviar al cliente
        //          2, codigo de status http
        return response()->json( 
            [ new BootcampCollection(Bootcamp::all())
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBootcampRequest $request)
    {
        /*//1.establecer reglas de validacion
        //2. Objeto validador
        $v = validator::make($request->all(),$reglas);
        //3. validar
        if($v->fails()){
            //response de error
            return response()->json( ["success"=> false,
            "error"=> $v->errors()
            ], 422);
        }
       // echo "permite regitrar un nuevo bootcamp";
       //1. traer el payload
       //2. Crea nuevo bootcamp*/
       return response()->json( ["success"=> true,
        "data"=> new BootcampResource(Bootcamp::create($request->all()))
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //echo "mostrar un bootcamp especifico cuyo id sea $id"; 
        return response()->json( ["success"=> true,
        "data"=> new BootcampResource(Bootcamp::find($id))
        ], 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //echo "para actualizar un bootcamp cuyo id es : $id";
        //localizar el bootcamp con el id
        $b = Bootcamp::find($id);
        //actualizar con update
        $b->update($request->all());
        return response()->json( ["success"=> true,
        "data"=> new BootcampResource($b)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //echo "elimina un bootcamp con id : $id";
        $b=Bootcamp::find($id);
        $b->delete();
        return response()->json( ["success"=> true,
        "data"=> $b 
        ], 200);
    }
}
