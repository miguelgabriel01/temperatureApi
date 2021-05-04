<?php

namespace App\Http\Controllers\Api;

use App\Models\Temperature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TemperatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //byscar todas as temperaturas no banco de dados
        $temperature = Temperature::all();
        return response()->json($temperature,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
         ['value' => 'required|numeric']
    );
    if($validator->fails()){
        $return = ['errors' => $validator->messages()];
        return response()->json($return,400);
    }

    Temperature::create($request->all());
    $return = ['message' => ['Temperature created successfully']];

    return response()->json($return,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Temperature  $temperature
     * @return \Illuminate\Http\Response
     */
    public function show(Temperature $temperature)
    {
        return response()->json($temperature,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Temperature  $temperature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Temperature $temperature)
    {
        $validator = Validator::make($request->all(),
        ['value' => 'required|numeric']
   );
   if($validator->fails()){
       $return = ['errors' => $validator->messages()];
       return response()->json($return,400);
   }

   $temperature->update($request->all());
   $return = ['message' => ['Temperature updated successfully']];

   return response()->json($return,200);

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Temperature  $temperature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Temperature $temperature)
    {
        $temperature->delete();
        $return = ['message' => ['Temperature deleted successfully']];

        return response()->json($return,200);
        }
}
