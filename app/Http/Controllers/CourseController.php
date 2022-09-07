<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Requests\StoreCoursesRequest;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CourseCollection;
use App\Http\Controllers\BaseController;

class CourseController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //metodo json
        //parametros: 1. data a encier al cliente
        //            2. codigo status http
        // return response()->json( new Bootcampcollection(Bootcamp::all())
        //                             ,200);
        try{
            return $this->sendResponse(new CourseCollection(Course::all()));
        }catch(\Exception $e){
            return $this->sendError( 'server error',500 );
        }
        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCoursesRequest $request, $id)
    {
        $curso = new Course();
        $curso->bootcamp_id = $id;
        $curso->title = $request->title;
        $curso->weeks = $request->weeks;
        $curso->description = $request->description;
        $curso->enroll_cost = $request->enroll_cost;
        $curso->minimum_skill = $request->minimum_skill;
        $curso->save();

        return response()->json( [
                                    "success" => true,
                                    "data" => $curso
                                ] , 200 );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json( [ "success" => true,
                                    "data" => new CourseResource(Course::find($id))
                                     ] ,200);
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
        $b = Course::find($id);
        //actializar con update
        $b->update($request->all());
        return response()->json([ "success" => true,
                                    "data" => new CourseResource($b)
                                ] , 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $b = Course::find($id);
        $b->delete($id);
        return $this->sendResponse(new CourseResource($b));
    }
}

