<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadosController;


Route::get('mensaje', [EmpleadosController::class,'mensaje']);

Route::get('controlpago', [EmpleadosController::class,'pago']);

Route::get('nomina/{diast}/{pago}', [EmpleadosController::class,'nomina']);

Route::get('muestrasaludo/{nombre}/{dias}', [EmpleadosController::class,'saludo']);

Route::get('salir', [EmpleadosController::class,'salir'])->name('salir');

Route::get('vb', [EmpleadosController::class,'vb'])->name('vb');

Route::get('vista1', [EmpleadosController::class,'vista1'])->name('vista1');

Route::get('vista2', [EmpleadosController::class,'vista2'])->name('vista2');

Route::get('altaempleado', [EmpleadosController::class,'altaempleado'])->name('altaempleado');

Route::post('guardarempleado', [EmpleadosController::class,'guardarempleado'])->name('guardarempleado');

Route::get('eloquent', [EmpleadosController::class,'eloquent'])->name('eloquent');

Route::get('reporteempleados', [EmpleadosController::class,'reporteempleados'])->name('reporteempleados');

Route::get('desactivaempleado/{ide}', [EmpleadosController::class,'desactivaempleado'])->name('desactivaempleado');

Route::get('activarempleado/{ide}', [EmpleadosController::class,'activarempleado'])->name('activarempleado');

Route::get('borraempleado/{ide}', [EmpleadosController::class,'borraempleado'])->name('borraempleado');

Route::get('modificaempleado/{ide}', [EmpleadosController::class,'modificaempleado'])->name('modificaempleado');

Route::post('guardacambios', [EmpleadosController::class,'guardacambios'])->name('guardacambios');

Route::get('/', function () {
    return view('welcome');
});