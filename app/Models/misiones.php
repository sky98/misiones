<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class misiones extends Model
{
    protected $table = "misiones";

    protected $fillable = [
    	'descripcion', 'cantidad_ninjas', 'prioridad', 'pago', 'estado', 'fecha_finalizacion', 'cliente_id'
    ];

    // Relacion mucho a muchos con usuarios (ninjas)
    public function users(){
    	return $this->belongsToMany('App\User');
    }

    // Relacion muchos a uno con cliente
    public function cliente(){
    	return $this->belongsToMany('App\Models\clientes');
    }
}
