<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\misiones;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return $user;
    }

    public function store(Request $request)
    {

    	$validator = Validator::make($request->all(), [
    		'nombre' => 'required',
    		'rango' => 'required',
    		'habilidades' => 'required',
    		'estado' => 'required',
    		'email' => 'require|email'
    	]);
    	if($validator->fails()){
    		return new JsonResponse($validator,422);
    	}

        $user = new User();
        $user->nombre = $request->nombre;
        $user->rango = $request->rango;
        $user->habilidades = $request->habilidades;
        $user->estado = $request->estado;
        $user->email = $request->email;
        $user->save();
        return $user;
    } 

    public function show($id)
    {
        $ConsultaUser = User::findOrFail($id);
        $ConsultaMisiones = misiones::where('cliente_id',$id)->get();
        $misiones = [];
        foreach ($ConsultaMisiones as $mision) {
            
            $aux =  [
                'codigo de la mision' => $mision->codigo_mision,
                'prioridad' => $mision->prioridad,
                'estado' => $mision->estado ,
                'fecha_finalizacion' => $mision->fecha_finalizacion ,
                'pago acordado' => $mision->pago ,
            ];
            $misiones[] = $aux;
        }
        $user = [
            'nombre' => $ConsultaUser->nombre,
            'rango' => $ConsultaUser->rango,
            'habilidades' => $ConsultaUser->habilidades,
            'estado' => $ConsultaUser->estado,
            'misiones' => $misiones,
        ];
        return $user;
    }

    public function update(Request $request, $id){

    	$user = User::findOrFail($id);
        $user->nombre = $request->nombre;
        $user->rango = $request->rango;
        $user->habilidades = $request->habilidades;
        $user->estado = $request->estado;
        $user->email = $request->email;
        $user->save();
        return $user;
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if($user != null){
            if($user->estado == "activo"){
               $user->estado = "retirado"; 
            }elseif ($user->estado == "retirado") {
                $user->estado = "fallecido";
            }elseif ($user->estado == "fallecido") {
                $user->estado = "desertor";
            }elseif ($user->estado == "desertor") {
               
            }
            $user->save();
        }        
        return $user;
    }


}
