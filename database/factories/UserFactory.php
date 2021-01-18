<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Models\clientes;
use App\Models\misiones;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'rango' => $faker->randomElement($array = array ('novato','soldado', 'veterano', 'maestro')),
        'habilidades' => $faker->text,
        'estado' => $faker->randomElement($array = array ('activo','retirado', 'fallecido', 'desertor')),
        'email' => $faker->unique()->safeEmail,
    ];
});

$factory->define(clientes::class, function (Faker $faker) {
    return [
        'codigo_secreto' => $faker->bothify('??##??#??'),
        'preferencia' => $faker->randomElement($array = array ('VIP','normal')),
    ];
});

$factory->define(misiones::class, function (Faker $faker) {
    return [
        'codigo_mision' => $faker->bothify('??####?????#??'),
        'descripcion' => $faker->text,
        'cantidad_ninjas' => $faker->numberBetween($min = 1, $max = 5),
        'prioridad' => $faker->randomElement($array = array ('normal','urgente')),
        'pago' => $faker->randomElement($array = array ('Dinero','Reputacion')),
        'estado' => $faker->randomElement($array = array ('pendiente','en curso', 'completado', 'fallado')),
        'fecha_finalizacion' => $faker->dateTimeInInterval($startDate = 'now', $interval = '+ 30 days', $timezone = null),
        'cliente_id' => $faker->numberBetween($min = 1, $max = 20),
    ];
});
