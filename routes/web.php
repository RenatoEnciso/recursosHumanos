<?php

use App\Http\Controllers\ActaNacimientoController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\ActaDefunsionController;
use App\Http\Controllers\ActaMatrimonioController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\InformeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

//USUARIO
Route::resource('usuario',UsuarioController::class);

//ACTA DE NACIMIENTO
Route::resource('ActaNacimiento',ActaNacimientoController::class);
Route::get('Confirmar{id}/', [ActaNacimientoController::class,'confirmar'])->name('ActaNacimiento.confirmar');
Route::get('Actacancelar',[ActaNacimientoController::class,'cancelar'])->name('ActaNacimiento.cancelar');
Route::get('Archi_ActaNacimiento{id}/',[ActaNacimientoController::class,'archivo'])->name('ActaNacimiento.archivo');

//ACTA DE DEFUNSION
Route::resource('ActaDefunsion',ActaDefunsionController::class);
Route::get('Confirmar{id}/CONF', [ActaDefunsionController::class,'confirmar'])->name('ActaDefunsion.confirmar');
Route::get('Actacancelar/CANC',[ActaDefunsionController::class,'cancelar'])->name('ActaDefunsion.cancelar');
Route::get('Archi_defuncion{id}/',[ActaDefunsionController::class,'archivo'])->name('ActaDefunsion.archivo');

//ACTA DE MATRIMONIO
Route::resource('ActaMatrimonio',ActaMatrimonioController::class);
Route::get('Confirmar{id}/Matri', [ActaMatrimonioController::class,'confirmar'])->name('ActaMatrimonio.confirmar');
Route::get('ActaMatrimoniocancelar',[ActaMatrimonioController::class,'cancelar'])->name('ActaMatrimonio.cancelar');
Route::get('ActaMatrimonio{id}/',[ActaMatrimonioController::class,'archivo'])->name('ActaMatrimonio.archivo');

//PERSONA
Route::resource('Persona',PersonaController::class);
Route::get('Personacancelar',[PersonaController::class,'cancelar'])->name('Persona.cancelar');
Route::get('confirmarP{id}/',[PersonaController::class,'confirmar'])->name('Persona.confirmar');

//CONSULTA
Route::resource('Solicitud',SolicitudController::class);
Route::get('confirmar{id}/',[SolicitudController::class,'confirmar'])->name('Solicitud.confirmar');

/* Route::get('actualizar{idS}{idActaSolicitud}/',[SolicitudController::class,'updates'])->name('Solicitud.actualiza');
Route::get('editar{idS}{idActaSolicitud}/',[SolicitudController::class,'editar'])->name('Solicitud.editar'); */
Route::get('Solicitudcancelar',[SolicitudController::class,'cancelar'])->name('Solicitud.cancelar');
Route::get('archivo{id}/',[SolicitudController::class,'archivo'])->name('Solicitud.archivo');

Route::get('archivoGenerado/{id}/',[SolicitudController::class,'OrdenGenerado'])->name('Solicitud.archivoGenerado');
Route::get('comprobanteGenerado/{id}/',[SolicitudController::class,'ComprobanteGenerado'])->name('Solicitud.comprobanteGenerado');
Route::put('pago/{id}/',[SolicitudController::class,'pago'])->name('Solicitud.pago');
Route::get('ingresarPago/{id}/',[SolicitudController::class,'ingresarPago'])->name('Solicitud.ingresarPago');

Route::get('index{id}/Detalle',[SolicitudController::class,'detalle'])->name('Solicitud.detalle');
Route::get('index{id}/Detalle',[SolicitudController::class,'detalle'])->name('Solicitud.detalle');


//Listar empleados y editar
Route::get('indexU', [RegisteredUserController::class, 'index'])->name('indexU');
Route::get('editU{id}/', [RegisteredUserController::class, 'edit'])->name('editU')->middleware('auth');
//Actualizando Empleado


Route::post('ActualizarEmpleado{id}/',[RegisteredUserController::class,'update'])->name('ActualizarPassword');
Route::get('confirU{id}/',[RegisteredUserController::class,'confirmar'])->name('confirU')->middleware('auth');
Route::post('EmpleadoEliminar{id}/', [RegisteredUserController::class, 'destroy'])->name('EliminarEmpleado');
Route::get('Empleadocancelar/',[RegisteredUserController::class,'cancelar'])->name('EmpleadoCancelar')->middleware('auth');
Route::get('InformeCrear', [InformeController::class, 'create'])->name('CrearInfo');
Route::post('InformeGe/', [InformeController::class,'Generar'])->name('GenerarInfo');

