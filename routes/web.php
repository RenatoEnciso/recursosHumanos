<?php
use App\Models\Ficha;
use App\Models\Oferta;
use App\Http\Controllers\ActaNacimientoController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\ActaDefunsionController;
use App\Http\Controllers\ActaMatrimonioController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BuscarActaDefuncion;
use App\Http\Controllers\BuscarActaMatrimonio;
use App\Http\Controllers\BuscarActaNacimiento;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\FichaController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SolicitudDNIController;

use App\Http\Controllers\HorarioController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\ContratoHorarioController;
use App\Http\Controllers\VacacionController;
use App\Http\Controllers\SolicitudDNIController;


//borrar
use App\Models\User;
// Route::get('/', function () {
//     return view('auth.login');
// });
Route::get('/', function () {
    return view('Externo.index');
});
// Route::get('Trabajar{$id}/Postulacion', [PostulacionController::class, 'indexP'])->name('indexT');
// Route::get('Trabajar{id}/Postulacion', [PostulacionController::class, 'indexP'])->name('indexT');
Route::get('Trabajar/Postulacion', [PostulacionController::class, 'indexP'])->name('indexT');


// Route::get('/trabajo', function () {
//     $Ofertas = Oferta::all()->where('estado', '=','1');
//     return view('Externo.Trabajar',compact('Ofertas'));
// });
Route::get('/login', function () {
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
        $usuarios = User::all();
        return view('Asistencia.index',compact('usuarios'));
});
Route::get('/inicio', function () {

    // $usarios = User::all();
    return view('Auth.home');
});

require __DIR__.'/auth.php';

//CONSULTAACTAS
    //ACTADEFUNCION
    Route::get('consulta_defuncion',[BuscarActaDefuncion::class,'index'])->name('ConsultaDefuncion');
    Route::post('validar_defuncion',[BuscarActaDefuncion::class,'search'])->name('SearchDefuncion');
    //ACTANACIMIENTO
    Route::get('consulta_nacimiento',[BuscarActaNacimiento::class,'index'])->name('ConsultaNacimiento');
    Route::post('validar_nacimiento',[BuscarActaNacimiento::class,'search'])->name('SearchNacimiento');
    //ACTAMATRIMONIO
    Route::get('consulta_matrimonio', [BuscarActaMatrimonio::class,'index'])->name('ConsultaMatrimonio');
    Route::post('validar_matrimonio',[BuscarActaMatrimonio::class,'search'])->name('SearchMatrimonio');
    //Salir de Acta
    Route::get('regresar',[BuscarActaDefuncion::class,'regresar'])->name('regresar');

//USUARIO
Route::resource('usuario',UsuarioController::class);

//Administrador
Route::resource('administrador',AdministradorController::class);
Route::get('Administradorcancelar',[AdministradorController::class,'cancelar'])->name('administrador.cancelar');

//SOLICITUD DNI
Route::resource('solicitud-dni', SolicitudDNIController::class); 
Route::get('solicitud-dni-cancelar', [SolicitudDNIController::class,'cancelar'])->name('solicitud-dni.cancelar');
Route::get('form-validacion', [SolicitudDNIController::class,'inicio'])->name('solicitudDNI.inicio');
Route::post('valida-datos', [SolicitudDNIController::class,'validar'])->name('solicitudDNI.validar');

//USUARIOS
Route::get('indexU', [RegisteredUserController::class, 'index'])->name('indexU');
Route::get('crearUsuario', [RegisteredUserController::class, 'create'])->name('crearUsuario');
Route::post('nuevoUsuario', [RegisteredUserController::class, 'storeP'])->name('nuevoUsuario');
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


//SOLICITUD
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


  //SOLICITUD DNI
Route::resource('solicitud-dni', SolicitudDNIController::class); 
Route::get('solicitud-dni-cancelar', [SolicitudDNIController::class,'cancelar'])->name('solicitud-dni.cancelar');
Route::get('form-validacion', [SolicitudDNIController::class,'inicio'])->name('solicitudDNI.inicio');
Route::post('valida-datos', [SolicitudDNIController::class,'validar'])->name('solicitudDNI.validar');


//1 Sprint Gestion Personal

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



Route::resource('Cargo',CargoController::class);
Route::get('Confirmar{id}/Cargo', [CargoController::class,'confirmar'])->name('Cargo.confirmar');
Route::get('Cargocancelar',[CargoController::class,'cancelar'])->name('Cargo.cancelar');

//2 Sprint Gestion Personal
//HORARIO


Route::resource('Horario',HorarioController::class);
Route::get('Confirmar{id}/Horario', [HorarioController::class,'confirmar'])->name('Horario.confirmar');
Route::get('Horariocancelar',[HorarioController::class,'cancelar'])->name('Horario.cancelar');

//TRABAJADOR
Route::resource('Trabajador',TrabajadorController::class);
Route::get('Confirmar{id}/Trabajador', [TrabajadorController::class,'confirmar'])->name('Trabajador.confirmar');
Route::get('Trabajadorcancelar',[TrabajadorController::class,'cancelar'])->name('Trabajador.cancelar');

//CONTRATO
Route::resource('Contrato',ContratoController::class);
Route::get('CreateP{id}/Contrato', [ContratoController::class,'createP'])->name('Contrato.createP');
Route::get('Confirmar{id}/Contrato', [ContratoController::class,'confirmar'])->name('Contrato.confirmar');
Route::get('Contratocancelar',[ContratoController::class,'cancelar'])->name('Contrato.cancelar');

// //CONTRATO
// Route::resource('Contrato',ContratoController::class);
// Route::get('Confirmar{id}/Contrato', [ContratoController::class,'confirmar'])->name('Contrato.confirmar');
// Route::get('Ofertacancelar',[ContratoController::class,'cancelar'])->name('Contrato.cancelar');

//CONTRATO_HORARIO
Route::resource('ContratoHorario',ContratoHorarioController::class);
Route::get('Confirmar{id}/ContratoHorario', [ContratoHorarioController::class,'confirmar'])->name('ContratoHorario.confirmar');
Route::get('ContratoHorariocancelar',[ContratoHorarioController::class,'cancelar'])->name('ContratoHorario.cancelar');

//VACACION
Route::resource('Vacacion',VacacionController::class);
Route::get('Confirmar{id}/Vacacion', [VacacionController::class,'confirmar'])->name('Vacacion.confirmar');
Route::get('Vacacioncancelar',[VacacionController::class,'cancelar'])->name('Vacacion.cancelar');
//Inicio 3 sprint

//ASISTENCIA
Route::resource('Asistencias',AsistenciaController::class);




