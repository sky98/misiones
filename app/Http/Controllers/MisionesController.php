<?php

namespace App\Http\Controllers;

use App\Models\misiones;
use Illuminate\Http\Request;
use Faker\Generator as Faker;
use App\User;

class MisionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $misiones = misiones::paginate(5);
        return $misiones;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::findOrFail($request->cliente_id);
        if($user != null){

           $misiones = new misiones();
            $misiones->codigo_mision = strtoupper(md5(uniqid(rand(),true)));
            $misiones->descripcion = $request->descripcion;
            $misiones->cantidad_ninjas = $request->cantidad_ninjas;
            $misiones->prioridad = $request->prioridad;
            $misiones->pago = $request->pago;
            $misiones->estado = "pendiente";
            $misiones->fecha_finalizacion = $request->fecha_finalizacion;
            $misiones->cliente_id = $request->cliente_id;
            $misiones->save(); 
        }  
        return $misiones;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\misiones  $misiones
     * @return \Illuminate\Http\Response
     */
    public function show(misiones $misiones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\misiones  $misiones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, misiones $misiones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\misiones  $misiones
     * @return \Illuminate\Http\Response
     */
    public function destroy(misiones $misiones)
    {
        //
    }
}
