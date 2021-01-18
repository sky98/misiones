<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMisionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('misiones', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_mision');
            $table->string('descripcion');
            $table->integer('cantidad_ninjas');
            $table->enum('prioridad', ['normal', 'urgente']);
            $table->string('pago');
            $table->enum('estado', ['pendiente', 'en curso', 'completado', 'fallado']);
            $table->date('fecha_finalizacion');
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('misiones');
    }
}
