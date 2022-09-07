<?php

namespace App\Http\Controllers;
use App\Models\Bootcamp;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBootcampRequest;
use App\Http\Resources\BootcampCollection;
use App\Http\Resources\BootcampResource;
use App\Http\Controllers\BaseController;
class BootcampController extends BaseController
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
        /*return response()->json( 
            [ new BootcampCollection(Bootcamp::all())
        ], 200);*/
        try {
            return $this ->sendResponse(new BootcampCollection(Bootcamp::all()));
        } catch (\Exception $e) {
            return $this->sendError('Serve Error',500);
        }
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
       $b= new Bootcamp();
       $b->name = $request->name;
       $b->description = $request->description;
       $b->website = $request->website;
       $b->phone = $request->phone;
       $b->average_rating = $request->phone;
       $b->average_cost = $request->phone;
        $b->save();
       try {
        return $this ->sendResponse(new BootcampResource($b),201);
    } catch (\Exception $th) {
        return $this->sendError('Serve Error',500);
    }
}   
      /* return response()->json( ["success"=> true,
        "data"=> new BootcampResource(Bootcamp::create($request->all()))
        ], 201);
    }*/

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function show($id)
    {
        try {
            $bootcamp = Bootcamp::find($id);
            if(!$bootcamp){
                return $this->sendError("Bootcamp with id:$id not found",400);
            }
            return $this->sendResponse(new BootcampResource($bootcamp));
        } catch (\Exeption $th) {
            return $this->sendError('Serve Error',500);
            
        }   //1. encontrar el bootcamp por id
        
        //2. en case de que el bootcamp no exista
        
        
        //echo "mostrar un bootcamp especifico cuyo id sea $id";   
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
        try 
        {
            $b = Bootcamp::find($id);
            if(!$b)
            {
                return $this->sendError("Bootcamp with id:$id not found",400);
            }
            $b->update($request->all());
            return $this->sendResponse(new BootcampResource($b));
        } catch (\Exception $e) 
        {
            return $this->sendError('Serve Error',500);
        }
        
        
        //
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try 
        {
            $b = Bootcamp::find($id);
            if(!$b)
            {
                return $this->sendError("Bootcamp with id:$id not found",400);
            }
            $b->update($request->all());
            return $this->sendResponse(new BootcampResource($b));
        } catch (\Exception $e) 
        {
            return $this->sendError('Serve Error',500);
        }
        
        
        //echo "elimina un bootcamp con id : $id";
        $b=Bootcamp::find($id);
        if(!$b){
            return $this->sendError("Bootcamp with id:$id not found",400);
        }
        $b->update($request->all());
        return $this->sendResponse(new BootcampResource($b));
    }
}
