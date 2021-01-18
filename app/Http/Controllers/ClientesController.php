<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\clientes;
use App\Models\misiones;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consultaClientes = clientes::all();
        $clientes = [];
        foreach ($consultaClientes as $cliente) {
            $hoy = Carbon::now();
            $antiguedad = $hoy->diffForHumans($cliente->created_at);
            $fecha = explode(" ", $antiguedad); 
            $numero = $fecha[0];
            $tiempo = $fecha[1];

            switch ($tiempo) {
                case 'years':
                    $tiempo = 'Años';
                break;
                case "months":
                    $tiempo = 'Mes';
                 break;
                case "weeks":
                    $tiempo = 'Semana';
                 break;
                case "days":
                    $tiempo = 'Día';
                break;
                case "hours":
                    $tiempo = 'Hora';
                break;
                case "minutes":
                    $tiempo = 'Minuto';
                break;
                case "seconds":
                    $tiempo = 'Segundos';
                break;
            }
            $diferencia = "Hace ".$numero." ".$tiempo;
            $aux =  [
                'codigo_secreto' => $cliente->codigo_secreto,
                'preferencia' => $cliente->preferencia,
                'antiguedad' => $diferencia ,
            ];
            $clientes[] = $aux;
        }

        return $clientes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $clientes = new clientes();
        $clientes->codigo_secreto = $request->codigo_secreto;
        $clientes->preferencia = $request->preferencia;
        $clientes->save();
        return $clientes;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ConsultaClientes = clientes::findOrFail($id);

        $ConsultaMisiones = misiones::where('cliente_id',$id)->get();
        $cliente = [];
        $misiones = [];

        foreach ($ConsultaMisiones as $mision) {
            
            $aux =  [
                'codigo de la mision' => $mision->codigo_mision,
                'prioridad' => $mision->prioridad,
                'estado' => $mision->estado ,
                'fecha' => $mision->fecha_finalizacion ,
                'pago acordado' => $mision->pago ,
            ];
            $misiones[] = $aux;
        }

        $cliente = [
            'codigo_secreto' => $ConsultaClientes->codigo_secreto,
            'preferencia' => $ConsultaClientes->preferencia,
            'misiones' => $misiones,
        ];
        return $cliente;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $clientes = clientes::findOrFail($id);
        $clientes->codigo_secreto = $request->codigo_secreto;
        $clientes->preferencia = $request->preferencia;
        $clientes->save();
        return $clientes;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(clientes $clientes)
    {
        //
    }
}
