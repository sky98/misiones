<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class clientes extends Model
{
    protected $table = "clientes";

    protected $fillable = [
    	'codigo_secreto', 'preferencia'
    ];

    // Relacion uno a muchos con misiones
    public function misiones(){
    	return $this->hasMany('App\Models\misiones');
    }

}
