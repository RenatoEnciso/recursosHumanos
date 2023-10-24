<?php
use App\Models\Ficha;

use App\Http\Controllers\ActaNacimientoController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\ActaDefunsionController;
use App\Http\Controllers\ActaMatrimonioController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\FichaController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\EntrevistaController;
use App\Http\Controllers\PostulacionController;
use App\Http\Controllers\CargoController;
use Illuminate\Support\Facades\Route;

//borrar
use App\Models\User;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {

    $fichasP = Ficha::all()->where('estado', 'Pendiente');
    return view('dashboard',compact('fichasP'));
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', function () {

        $fichasP = Ficha::all()->where('estado', 'Pendiente');
    return view('index',compact('fichasP'));
})->middleware(['auth'])->name('dashboard');

Route::get('/probarFace', function () {

        $usarios = User::all();
        return view('Asistencia/index',compact('usarios'));
});

require __DIR__.'/auth.php';

//USUARIO
Route::resource('usuario',UsuarioController::class);

//Administrador
Route::resource('administrador',AdministradorController::class);
Route::get('Administradorcancelar',[AdministradorController::class,'cancelar'])->name('administrador.cancelar');

//USUARIOS
Route::get('indexU', [RegisteredUserController::class, 'index'])->name('indexU');
Route::get('editU{id}/', [RegisteredUserController::class, 'edit'])->name('editU')->middleware('auth');
Route::post('ActualizarEmpleado{id}/',[RegisteredUserController::class,'update'])->name('ActualizarPassword');
Route::get('confirU{id}/',[RegisteredUserController::class,'confirmar'])->name('confirU')->middleware('auth');
Route::post('EmpleadoEliminar{id}/', [RegisteredUserController::class, 'destroy'])->name('EliminarEmpleado');
Route::get('Empleadocancelar/',[RegisteredUserController::class,'cancelar'])->name('EmpleadoCancelar')->middleware('auth');


//FICHAS
Route::resource('Ficha',FichaController::class);
Route::get('Fichacancelar',[FichaController::class,'cancelar'])->name('Ficha.cancelar');
Route::get('FichaConfirmar/{id}',[FichaController::class,'confirmar'])->name('Ficha.confirmar');
Route::get('FichaCrearActa/{id}',[FichaController::class,'crearActa'])->name('Ficha.crearActa');

//ACTA DE NACIMIENTO
Route::resource('ActaNacimiento',ActaNacimientoController::class);
Route::get('Confirmar{id}/', [ActaNacimientoController::class,'confirmar'])->name('ActaNacimiento.confirmar');
Route::get('Actacancelar',[ActaNacimientoController::class,'cancelar'])->name('ActaNacimiento.cancelar');
Route::get('Archi_ActaNacimiento{id}/',[ActaNacimientoController::class,'archivo'])->name('ActaNacimiento.archivo');
Route::get('ActaGenerada_ActaNacimiento{id}/',[ActaNacimientoController::class,'actaGenerada'])->name('ActaNacimiento.generada');
Route::get('/ActaNacimiento/revisar/{id}', [ActaNacimientoController::class,'revisar'])->name('ActaNacimiento.revisar');

//ACTA DE DEFUNCION
Route::resource('ActaDefunsion',ActaDefunsionController::class);
Route::get('Confirmar{id}/CONF', [ActaDefunsionController::class,'confirmar'])->name('ActaDefunsion.confirmar');
Route::get('Actacancelar/CANC',[ActaDefunsionController::class,'cancelar'])->name('ActaDefunsion.cancelar');
Route::get('Archi_defuncion{id}/',[ActaDefunsionController::class,'archivo'])->name('ActaDefunsion.archivo');
Route::get('ActaGenerada_defuncion{id}/',[ActaDefunsionController::class,'actaGenerada'])->name('ActaDefuncion.generada');
Route::get('/ActaDefuncion/revisar/{id}', [ActaDefunsionController::class,'revisar'])->name('ActaDefuncion.revisar');

//ACTA DE MATRIMONIO
Route::resource('ActaMatrimonio',ActaMatrimonioController::class);
Route::get('Confirmar{id}/Matri', [ActaMatrimonioController::class,'confirmar'])->name('ActaMatrimonio.confirmar');
Route::get('ActaMatrimoniocancelar',[ActaMatrimonioController::class,'cancelar'])->name('ActaMatrimonio.cancelar');
Route::get('ActaMatrimonio{id}/',[ActaMatrimonioController::class,'archivo'])->name('ActaMatrimonio.archivo');
Route::get('ActaGenerada_ActaMatrimonio{id}/',[ActaMatrimonioController::class,'actaGenerada'])->name('ActaMatrimonio.generada');
//Route::get('ActaCrear{id}/',[ActaMatrimonioController::class,'create'])->name('ActaMatrimonio.crear');
//Route::post('ActaStore{id}/',[ActaMatrimonioController::class,'store'])->name('ActaMatrimonio.store');
Route::get('ActaMatrimonio/revisar/{id}', [ActaMatrimonioController::class,'revisar'])->name('ActaMatrimonio.revisar');

//PERSONA
Route::resource('Persona',PersonaController::class);
Route::get('Personacancelar',[PersonaController::class,'cancelar'])->name('Persona.cancelar');
Route::get('confirmarP{id}/',[PersonaController::class,'confirmar'])->name('Persona.confirmar');


//CONSULTA
Route::resource('Solicitud',SolicitudController::class);
Route::get('confirmar{id}/',[SolicitudController::class,'confirmar'])->name('Solicitud.confirmar');
Route::get('Solicitudcancelar',[SolicitudController::class,'cancelar'])->name('Solicitud.cancelar');
Route::get('archivo{id}/',[SolicitudController::class,'archivo'])->name('Solicitud.archivo');
Route::get('archivoGenerado/{id}/',[SolicitudController::class,'OrdenGenerado'])->name('Solicitud.archivoGenerado');
Route::get('comprobanteGenerado/{id}/',[SolicitudController::class,'ComprobanteGenerado'])->name('Solicitud.comprobanteGenerado');
Route::put('pago/{id}/',[SolicitudController::class,'pago'])->name('Solicitud.pago');
Route::get('ingresarPago/{id}/',[SolicitudController::class,'ingresarPago'])->name('Solicitud.ingresarPago');
Route::get('index{id}/Detalle',[SolicitudController::class,'detalle'])->name('Solicitud.detalle');
Route::get('index{id}/Detalle',[SolicitudController::class,'detalle'])->name('Solicitud.detalle');



//REPORTES
Route::get('Reporte/Crear', [ReporteController::class, 'create'])->name('reporte.create');
Route::get('Reporte/PDF/', [ReporteController::class,'generarPDF'])->name('reporte.generarPDF');

//OFERTAS
Route::resource('Oferta',OfertaController::class);
Route::get('Confirmar{id}/Oferta', [OfertaController::class,'confirmar'])->name('Oferta.confirmar');
Route::get('Ofertacancelar',[OfertaController::class,'cancelar'])->name('Oferta.cancelar');
//ENTREVISTA
Route::get('Entrevista{id}/Entrevista', [EntrevistaController::class,'createP'])->name('Entrevista.createP');
Route::resource('Entrevista',EntrevistaController::class);
Route::get('Confirmar{id}/Entrevista', [EntrevistaController::class,'confirmar'])->name('Entrevista.confirmar');
Route::get('Entrevistacancelar',[EntrevistaController::class,'cancelar'])->name('Entrevista.cancelar');
//POSTULACION
Route::resource('Postulacion',PostulacionController::class);
Route::get('CreateP{id}/Postulacion', [PostulacionController::class,'createP'])->name('Postulacion.createP');
Route::get('Confirmar{id}/Postulacion', [PostulacionController::class,'confirmar'])->name('Postulacion.confirmar');
Route::get('Postulacioncancelar',[PostulacionController::class,'cancelar'])->name('Postulacion.cancelar');

//CARGO

Route::resource('Cargo',CargoController::class);
Route::get('Confirmar{id}/Cargo', [CargoController::class,'confirmar'])->name('Cargo.confirmar');
Route::get('Cargocancelar',[CargoController::class,'cancelar'])->name('Cargo.cancelar');