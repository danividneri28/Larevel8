<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ruta1', function () {
    return "Hola mundo";
});

Route::get('/arearectangulo', function () {
    $base = 4;
    $altura = 10;
    $area = $base * $altura;

    return $area;
});

Route::get('/arearectangulo2', function () {
    $base = 4;
    $altura = 10;
    $area = $base * $altura;

    return "El area del rectangulo es: $area con base $base y altura $altura";
});