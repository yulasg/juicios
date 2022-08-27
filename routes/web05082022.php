<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AbogadoController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\DatoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemandaController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\ExternoController;
use App\Http\Controllers\GarantiaController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\InternoController;
use App\Http\Controllers\JuicioController;
use App\Http\Controllers\JuzgadoController;
use App\Http\Controllers\MedidaController;
use App\Http\Controllers\ObligacionController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\PretensionController;
use App\Http\Controllers\TribunalController;
//use App\Http\Controllers\DatatableController;
use App\Http\Controllers\EstatuController;
use App\Http\Controllers\MigracionAbogadoController;
use App\Http\Controllers\MigracionActividadController;
use App\Http\Controllers\MigracionAgendaController;
use App\Http\Controllers\MigracionComodinController;
use App\Http\Controllers\MigracionDatoController;
use App\Http\Controllers\MigracionMedidaController;
use App\Http\Controllers\MigracionDemandaController;
use App\Http\Controllers\MigracionEstadoController;
use App\Http\Controllers\MigracionExternoController;
use App\Http\Controllers\MigracionFuncionarioController;
use App\Http\Controllers\MigracionGarantiaController;
use App\Http\Controllers\MigracionInternoController;
use App\Http\Controllers\MigracionJuicioController;
use App\Http\Controllers\MigracionJuzgadoController;
use App\Http\Controllers\MigracionMovimientoController;
use App\Http\Controllers\MigracionObligacionController;
use App\Http\Controllers\MigracionPagareController;
use App\Http\Controllers\MigracionPersonaController;
use App\Http\Controllers\MigracionPretensionController;
use App\Http\Controllers\MigracionProcedenciaController;
use App\Http\Controllers\MigracionRelacionController;
use App\Http\Controllers\MigracionSeguimientoController;
use App\Http\Controllers\MigracionTribunalController;
use App\Http\Controllers\MigracionUbicacionController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\ProcedenciaController;
use App\Http\Controllers\ReferenciaController;
use App\Http\Controllers\RelacionController;
use App\Http\Controllers\RepresentanteController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\UbicacionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//Route::get('registrosjuicios',  [DatatableController::class,'juicio'])->name('registrosjuicios');
Route::get('/', function () {
    return redirect('/login');
});

// Homepage Route
Route::group(['middleware' => ['web']], function () {
    //Route::get('/', 'App\Http\Controllers\WelcomeController@welcome')->name('welcome');
    Route::get('/terms', 'App\Http\Controllers\TermsController@terms')->name('terms');
});

// Authentication Routes
Auth::routes();

// Public Routes
Route::group(['middleware' => ['web', 'activity']], function () {

    // Activation Routes
    Route::get('/activate', ['as' => 'activate', 'uses' => 'App\Http\Controllers\Auth\ActivateController@initial']);

    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'App\Http\Controllers\Auth\ActivateController@activate']);
    Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'App\Http\Controllers\Auth\ActivateController@resend']);
    Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'App\Http\Controllers\Auth\ActivateController@exceeded']);

    // Socialite Register Routes
    Route::get('/social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'App\Http\Controllers\Auth\SocialController@getSocialRedirect']);
    Route::get('/social/handle/{provider}', ['as' => 'social.handle', 'uses' => 'App\Http\Controllers\Auth\SocialController@getSocialHandle']);

    // Route to for user to reactivate their user deleted account.
    Route::get('/re-activate/{token}', ['as' => 'user.reactivate', 'uses' => 'App\Http\Controllers\RestoreUserController@userReActivate']);
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity']], function () {

    // Activation Routes
    Route::get('/activation-required', ['uses' => 'App\Http\Controllers\Auth\ActivateController@activationRequired'])->name('activation-required');
    Route::get('/logout', ['uses' => 'App\Http\Controllers\Auth\LoginController@logout'])->name('logout');
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'role:gerente' , 'activity']], function () {

    Route::get('/', InicioController::class)->name('inicio');
    Route::get('registrostribunales/{id}',  [TribunalController::class, 'byJuzgado'])->name('registrostribunales');
    Route::get('registrosjuzgados/{id}',  [JuzgadoController::class, 'byTribunal'])->name('registrosjuzgados');

    Route::get('todosjuzgados',  [JuzgadoController::class, 'allJuzgados'])->name('todosjuzgados');


    //Route::get('registrospersonas/{juicio_id}/{tipo}',  [PersonaController::class,'byPersona'])->name('registrospersonas');
    Route::get('registrosestatus/{terminado}',  [EstatuController::class, 'byEstatu'])->name('registrosestatus}');
    Route::get('buscarestatu/{id}',  [EstatuController::class, 'byBuscarEstatu'])->name('buscarestatu}');
    Route::get('registrosabogados/{juicio_id}',  [AbogadoController::class, 'byAbogados'])->name('registrosabogados');
    //Route::get('demandado/{id}', [PersonaController::class, 'edit'])->name('demandado.edit');
    //Route::post('demandado/{id}', [PersonaController::class, 'update'])->name('demandado.update');
    //Route::get('demandante/{id}', [PersonaController::class, 'edit'])->name('demandante.edit');
    //Route::post('demandante/{id}', [PersonaController::class, 'update'])->name('demandante.update');
    Route::get('registrosespecialidades/{id}',  [EspecialidadController::class, 'byInternacional'])->name('registrosespecialidades');
    Route::get('registrosconfiguraciones/{id}',  [ConfiguracionController::class, 'byEspecialidad'])->name('registrosconfiguraciones');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes tribunales
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('tribunales', [TribunalController::class, 'index'])->name('tribunales.index');
    Route::get('tribunal/eliminar/{id}', [TribunalController::class, 'eliminar'])->name('tribunales.eliminar');
    Route::post('tribunales/{tribunal}/restore', [TribunalController::class, 'restore'])->name('tribunales.restore');
    Route::post('tribunales/{tribunal}/forceDelete', [TribunalController::class, 'forceDelete'])->name('tribunales.forceDelete');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes estatus 
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('estatus', [EstatuController::class, 'index'])->name('estatus.index');
    Route::get('estatu/eliminar/{id}', [EstatuController::class, 'eliminar'])->name('estatus.eliminar');
    Route::post('estatus/{estatu}/restore', [EstatuController::class, 'restore'])->name('estatus.restore');
    Route::post('estatus/{estatu}/forceDelete', [EstatuController::class, 'forceDelete'])->name('estatus.forceDelete');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes procedencias (Bancos en liquidación)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('procedencias', [ProcedenciaController::class, 'index'])->name('procedencias.index');
    Route::get('procedencia/eliminar/{id}', [ProcedenciaController::class, 'eliminar'])->name('procedencias.eliminar');
    Route::post('procedencias/{procedencia}/restore', [ProcedenciaController::class, 'restore'])->name('procedencias.restore');
    Route::post('procedencias/{procedencia}/forceDelete', [ProcedenciaController::class, 'forceDelete'])->name('procedencias.forceDelete');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes especialidades (Ramas del juicio)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('especialidades', [EspecialidadController::class, 'index'])->name('especialidades.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes configuraciones (Configurar la especialidad o rama del juicio)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('configuraciones', [ConfiguracionController::class, 'index'])->name('configuraciones.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes demandas (tipo de proceso)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('demandas', [DemandaController::class, 'index'])->name('demandas.index');
    Route::get('demanda/eliminar/{id}', [DemandaController::class, 'eliminar'])->name('demandas.eliminar');
    Route::post('demandas/{demanda}/restore', [DemandaController::class, 'restore'])->name('demandas.restore');
    Route::post('demandas/{demanda}/forceDelete', [DemandaController::class, 'forceDelete'])->name('demandas.forceDelete');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes demandas (tipo de proceso)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('tipos', [TipoController::class, 'index'])->name('tipos.index');
    Route::get('tipo/eliminar/{id}', [TipoController::class, 'eliminar'])->name('tipos.eliminar');
    Route::post('tipos/{tipo}/restore', [TipoController::class, 'restore'])->name('tipos.restore');
    Route::post('tipos/{tipo}/forceDelete', [TipoController::class, 'forceDelete'])->name('tipos.forceDelete');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes medidas
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('medidas', [MedidaController::class, 'index'])->name('medidas.index');
    Route::get('medida/eliminar/{id}', [MedidaController::class, 'eliminar'])->name('medidas.eliminar');
    Route::post('medidas/{medida}/restore', [MedidaController::class, 'restore'])->name('medidas.restore');
    Route::post('medidas/{medida}/forceDelete', [MedidaController::class, 'forceDelete'])->name('medidas.forceDelete');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes obligaciones
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('obligaciones', [ObligacionController::class, 'index'])->name('obligaciones.index');
    Route::get('obligacion/eliminar/{id}', [ObligacionController::class, 'eliminar'])->name('obligaciones.eliminar');
    Route::post('obligaciones/{obligacion}/restore', [ObligacionController::class, 'restore'])->name('obligaciones.restore');
    Route::post('obligaciones/{obligacion}/forceDelete', [ObligacionController::class, 'forceDelete'])->name('obligaciones.forceDelete');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes pretensiones
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('pretensiones', [PretensionController::class, 'index'])->name('pretensiones.index');
    Route::get('pretension/eliminar/{id}', [PretensionController::class, 'eliminar'])->name('pretensiones.eliminar');
    Route::post('pretensiones/{pretension}/restore', [PretensionController::class, 'restore'])->name('pretensiones.restore');
    Route::post('pretensiones/{pretension}/forceDelete', [PretensionController::class, 'forceDelete'])->name('pretensiones.forceDelete');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes garantias
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('garantias', [GarantiaController::class, 'index'])->name('garantias.index');
    Route::get('garantia/eliminar/{id}', [GarantiaController::class, 'eliminar'])->name('garantias.eliminar');
    Route::post('garantias/{garantia}/restore', [GarantiaController::class, 'restore'])->name('garantias.restore');
    Route::post('garantias/{garantia}/forceDelete', [GarantiaController::class, 'forceDelete'])->name('garantias.forceDelete');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes juzgados
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('juzgados', [JuzgadoController::class, 'index'])->name('juzgados.index');
    Route::get('juzgado/eliminar/{id}', [JuzgadoController::class, 'eliminar'])->name('juzgados.eliminar');
    Route::post('juzgados/{juzgado}/restore', [JuzgadoController::class, 'restore'])->name('juzgados.restore');
    Route::post('juzgados/{juzgado}/forceDelete', [JuzgadoController::class, 'forceDelete'])->name('juzgados.forceDelete');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes internos (Abogados internos)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('internos', [InternoController::class, 'index'])->name('internos.index');
    Route::get('interno/eliminar/{id}', [InternoController::class, 'eliminar'])->name('internos.eliminar');
    Route::post('internos/{interno}/restore', [InternoController::class, 'restore'])->name('internos.restore');
    Route::post('internos/{interno}/forceDelete', [InternoController::class, 'forceDelete'])->name('internos.forceDelete');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes actividades (Actividad procesal)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('actividades', [ActividadController::class, 'index'])->name('actividades.index');
    Route::get('actividad/eliminar/{id}', [ActividadController::class, 'eliminar'])->name('actividades.eliminar');
    Route::post('actividades/{actividad}/restore', [ActividadController::class, 'restore'])->name('actividades.restore');
    Route::post('actividades/{actividad}/forceDelete', [ActividadController::class, 'forceDelete'])->name('actividades.forceDelete');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes externos (Abogados externos)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('externos', [ExternoController::class, 'index'])->name('externos.index');
    Route::get('externo/eliminar/{id}', [ExternoController::class, 'eliminar'])->name('externos.eliminar');
    Route::post('externos/{externo}/restore', [ExternoController::class, 'restore'])->name('externos.restore');
    Route::post('externos/{externo}/forceDelete', [ExternoController::class, 'forceDelete'])->name('externos.forceDelete');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes estados (Estado procesal)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('estados', [EstadoController::class, 'index'])->name('estados.index');
    Route::get('estado/eliminar/{id}', [EstadoController::class, 'eliminar'])->name('estados.eliminar');
    Route::post('estados/{estado}/restore', [EstadoController::class, 'restore'])->name('estados.restore');
    Route::post('estados/{estado}/forceDelete', [EstadoController::class, 'forceDelete'])->name('estados.forceDelete');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes ubicaciones (Estados de venezuela)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('ubicaciones', [UbicacionController::class, 'index'])->name('ubicaciones.index');
    Route::get('ubicacion/eliminar/{id}', [UbicacionController::class, 'eliminar'])->name('ubicaciones.eliminar');
    Route::post('ubicaciones/{ubicacion}/restore', [UbicacionController::class, 'restore'])->name('ubicaciones.restore');
    Route::post('ubicaciones/{ubicacion}/forceDelete', [UbicacionController::class, 'forceDelete'])->name('ubicaciones.forceDelete');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes juicios (Ficha del juicio)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('juicios', [JuicioController::class, 'index'])->name('juicios.index');
    Route::get('juicios/eliminar/{id}', [JuicioController::class, 'eliminar'])->name('juicios.eliminar');
    Route::get('juicio/consulta', [JuicioController::class, 'consulta'])->name('juicios.consulta');
    Route::get('juicio/consultajuicio', [JuicioController::class, 'consultajuicio'])->name('juicios.consultajuicio');
    Route::get('juicio/consultamovimiento', [JuicioController::class, 'consultamovimiento'])->name('juicios.consultamovimiento');
    Route::post('juicios/{juicio}/restore', [JuicioController::class, 'restore'])->name('juicios.restore');
    Route::post('juicios/{juicio}/forceDelete', [JuicioController::class, 'forceDelete'])->name('juicios.forceDelete');
    /* 
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes seguimientos (Seguimiento del juicio)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('seguimientos/{id}', [SeguimientoController::class, 'index'])->name('seguimientos.index');
    Route::get('seguimientos/eliminar/{id}', [SeguimientoController::class, 'eliminar'])->name('seguimientos.eliminar');
    Route::post('seguimientos/{seguimiento}/restore', [SeguimientoController::class, 'restore'])->name('seguimientos.restore');
    Route::post('seguimientos/{seguimiento}/forceDelete', [SeguimientoController::class, 'forceDelete'])->name('seguimientos.forceDelete');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes movimientos (Actividades relacionadas con la ficha del juicio)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('movimientos/{id}', [MovimientoController::class, 'index'])->name('movimientos.index');
    Route::get('movimientos/eliminar/{id}', [MovimientoController::class, 'eliminar'])->name('movimientos.eliminar');
    Route::post('movimientos/{movimiento}/restore', [MovimientoController::class, 'restore'])->name('movimientos.restore');
    Route::post('movimientos/{movimiento}/forceDelete', [MovimientoController::class, 'forceDelete'])->name('movimientos.forceDelete');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes agendas (Agenda de las actividades relacionadas a la ficha del juicio)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::resource('agendas', AgendaController::class)->only('index');
    Route::get('agendas/eliminar/{id}', [AgendaController::class, 'eliminar'])->name('agendas.eliminar');
    Route::get('agenda/buscar', [AgendaController::class, 'buscar'])->name('agenda.buscar');
    Route::post('agendas/{agenda}/restore', [AgendaController::class, 'restore'])->name('agendas.restore');
    Route::post('agendas/{agenda}/forceDelete', [AgendaController::class, 'forceDelete'])->name('agendas.forceDelete');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes relaciones (Relación entre juicios)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('relaciones/{id}', [RelacionController::class, 'index'])->name('relaciones.index');
    Route::post('relaciones', [RelacionController::class, 'store'])->name('relaciones.store');
    Route::get('relaciones/eliminar/{id}', [RelacionController::class, 'eliminar'])->name('relaciones.eliminar');
    Route::post('relaciones/{relacion}/restore', [RelacionController::class, 'restore'])->name('relaciones.restore');
    Route::post('relaciones/{relacion}/forceDelete', [RelacionController::class, 'forceDelete'])->name('relaciones.forceDelete');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes datos (Datos extras de la ficha del juicios)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('datos/{id}', [DatoController::class, 'index'])->name('datos.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes abogados (Asiganar abogado interno al juicio)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('abogados/{id}', [AbogadoController::class, 'index'])->name('abogados.index');
    Route::post('abogados', [AbogadoController::class, 'store'])->name('abogados.store');
    Route::get('abogados/eliminar/{id}', [AbogadoController::class, 'eliminar'])->name('abogados.eliminar');
    Route::post('abogados/{abogado}/restore', [AbogadoController::class, 'restore'])->name('abogados.restore');
    Route::post('abogados/{abogado}/forceDelete', [AbogadoController::class, 'forceDelete'])->name('abogados.forceDelete');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes documentos (pagares de la ficha de juicio)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('documentos/{id}', [DocumentoController::class, 'index'])->name('documentos.index');
    Route::get('documentos/eliminar/{id}', [DocumentoController::class, 'eliminar'])->name('documentos.eliminar');
    Route::post('documentos/{documento}/restore', [DocumentoController::class, 'restore'])->name('documentos.restore');
    Route::post('documentos/{documento}/forceDelete', [DocumentoController::class, 'forceDelete'])->name('documentos.forceDelete');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes referencias (datos de las partes actorales de cada ficha de juicio)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('referencias', [ReferenciaController::class, 'index'])->name('referencias.index');
    Route::get('referencias/eliminar/{id}', [ReferenciaController::class, 'eliminar'])->name('referencias.eliminar');
    Route::get('referencia/consulta', [ReferenciaController::class, 'consulta'])->name('referencias.consulta');
    Route::post('referencias/{referencia}/restore', [ReferenciaController::class, 'restore'])->name('referencias.restore');
    Route::post('referencias/{referencia}/forceDelete', [ReferenciaController::class, 'forceDelete'])->name('referencias.forceDelete');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes representantes
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('representantes', [RepresentanteController::class, 'index'])->name('representantes.index');
    Route::get('representantes/eliminar/{id}', [RepresentanteController::class, 'eliminar'])->name('representantes.eliminar');
    Route::post('representantes/{representante}/restore', [RepresentanteController::class, 'restore'])->name('representantes.restore');
    Route::post('representantes/{representante}/forceDelete', [RepresentanteController::class, 'forceDelete'])->name('representantes.forceDelete');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes actores (parte actoral) 
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('actores/{id}/{especialidad}/{representante}', [ActorController::class, 'index'])->name('actores.index');
    Route::get('actor/eliminar/{id}', [ActorController::class, 'eliminar'])->name('actores.eliminar');
    Route::post('actores/{actor}/restore', [ActorController::class, 'restore'])->name('actores.restore');
    Route::post('actores/{actor}/forceDelete', [ActorController::class, 'forceDelete'])->name('actores.forceDelete');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes personas  
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('personas/{id}/{especialidad}/{representante}', [PersonaController::class, 'index'])->name('personas.index');
    Route::get('persona/eliminar/{id}', [PersonaController::class, 'eliminar'])->name('personas.eliminar');
    Route::get('persona/consulta', [PersonaController::class, 'consulta'])->name('personas.consulta');
    Route::post('personas/{persona}/restore', [PersonaController::class, 'restore'])->name('personas.restore');
    Route::post('personas/{persona}/forceDelete', [PersonaController::class, 'forceDelete'])->name('personas.forceDelete');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes migraciones 
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('migracionesmedida', [MigracionMedidaController::class, 'Medida'])->name('migracionesmedida.medida');
    Route::get('migracionesobligacion', [MigracionObligacionController::class, 'Obligacion'])->name('migracionesobligacion.obligacion');
    Route::get('migracionesgarantia', [MigracionGarantiaController::class, 'Garantia'])->name('migracionesgarantia.garantia');
    Route::get('migracionesinterno', [MigracionInternoController::class, 'Interno'])->name('migracionesinterno.interno');
    Route::get('migracionesjuzgado', [MigracionJuzgadoController::class, 'Juzgado'])->name('migracionesjuzgado.juzgado');
    Route::get('migracionesexterno', [MigracionExternoController::class, 'Externo'])->name('migracionesexterno.externo');
    Route::get('migracionespretension', [MigracionPretensionController::class, 'Pretension'])->name('migracionespretension.pretension');
    Route::get('migracionesestado', [MigracionEstadoController::class, 'Estado'])->name('migracionesestado.estado');
    Route::get('migracionesprocedencia', [MigracionProcedenciaController::class, 'Procedencia'])->name('migracionesprocedencia.procedencia');
    Route::get('migracionesubicacion', [MigracionUbicacionController::class, 'Ubicacion'])->name('migracionesubicacion.ubicacion');
    Route::get('migracionesactividad', [MigracionActividadController::class, 'Actividad'])->name('migracionesactividad.actividad');
    Route::get('migracionesdemanda', [MigracionDemandaController::class, 'Demanda'])->name('migracionesdemanda.demanda');
    Route::get('migracionesfuncionario', [MigracionFuncionarioController::class, 'Funcionario'])->name('migracionesfuncionario.funcionario');
    Route::get('migracionestribunal', [MigracionTribunalController::class, 'Tribunal'])->name('migracionestribunal.tribunal');
    Route::get('migracionesjuicio', [MigracionJuicioController::class, 'Juicio'])->name('migracionesjuicio.juicio');
    Route::get('migracionespersona', [MigracionPersonaController::class, 'Persona'])->name('migracionespersona.persona');
    Route::get('migracionescomodin', [MigracionComodinController::class, 'Comodin'])->name('migracionescomodin.comodin');
    Route::get('migracionesdato', [MigracionDatoController::class, 'Dato'])->name('migracionesdato.dato');
    Route::get('migracionesrelacion', [MigracionRelacionController::class, 'Relacion'])->name('migracionesrelacion.relacion');
    Route::get('migracionesseguimiento', [MigracionSeguimientoController::class, 'Seguimiento'])->name('migracionesseguimiento.seguimiento');
    Route::get('migracionesmovimiento', [MigracionMovimientoController::class, 'Movimiento'])->name('migracionesmovimiento.movimiento');
    Route::get('migracionesagenda', [MigracionAgendaController::class, 'Agenda'])->name('migracionesagenda.agenda');
    Route::get('migracionespagare', [MigracionPagareController::class, 'Pagare'])->name('migracionespagare.pagare');
    Route::get('migracionesabogado', [MigracionAbogadoController::class, 'Abogado'])->name('migracionesabogado.abogado');

    //  Homepage Route - Redirect based on user role is in controller. 
    Route::get('/home', ['as' => 'public.home',   'uses' => 'App\Http\Controllers\UserController@index']);

    // Show users profile - viewable by other users.
    Route::get('profile/{username}', [
        'as'   => '{username}',
        'uses' => 'App\Http\Controllers\ProfilesController@show',
    ]);
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'role:abogado' , 'activity']], function () {

    Route::get('/', InicioController::class)->name('inicio');
    Route::get('registrostribunales/{id}',  [TribunalController::class, 'byJuzgado'])->name('registrostribunales');
    Route::get('registrosjuzgados/{id}',  [JuzgadoController::class, 'byTribunal'])->name('registrosjuzgados');

    Route::get('todosjuzgados',  [JuzgadoController::class, 'allJuzgados'])->name('todosjuzgados');


    //Route::get('registrospersonas/{juicio_id}/{tipo}',  [PersonaController::class,'byPersona'])->name('registrospersonas');
    Route::get('registrosestatus/{terminado}',  [EstatuController::class, 'byEstatu'])->name('registrosestatus}');
    Route::get('buscarestatu/{id}',  [EstatuController::class, 'byBuscarEstatu'])->name('buscarestatu}');
    Route::get('registrosabogados/{juicio_id}',  [AbogadoController::class, 'byAbogados'])->name('registrosabogados');
    //Route::get('demandado/{id}', [PersonaController::class, 'edit'])->name('demandado.edit');
    //Route::post('demandado/{id}', [PersonaController::class, 'update'])->name('demandado.update');
    //Route::get('demandante/{id}', [PersonaController::class, 'edit'])->name('demandante.edit');
    //Route::post('demandante/{id}', [PersonaController::class, 'update'])->name('demandante.update');
    Route::get('registrosespecialidades/{id}',  [EspecialidadController::class, 'byInternacional'])->name('registrosespecialidades');
    Route::get('registrosconfiguraciones/{id}',  [ConfiguracionController::class, 'byEspecialidad'])->name('registrosconfiguraciones');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes tribunales
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('tribunales', [TribunalController::class, 'index'])->name('tribunales.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes estatus 
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('estatus', [EstatuController::class, 'index'])->name('estatus.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes procedencias (Bancos en liquidación)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('procedencias', [ProcedenciaController::class, 'index'])->name('procedencias.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes especialidades (Ramas del juicio)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('especialidades', [EspecialidadController::class, 'index'])->name('especialidades.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes configuraciones (Configurar la especialidad o rama del juicio)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('configuraciones', [ConfiguracionController::class, 'index'])->name('configuraciones.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes demandas (tipo de proceso)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('demandas', [DemandaController::class, 'index'])->name('demandas.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes demandas (tipo de proceso)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('tipos', [TipoController::class, 'index'])->name('tipos.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes medidas
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('medidas', [MedidaController::class, 'index'])->name('medidas.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes obligaciones
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('obligaciones', [ObligacionController::class, 'index'])->name('obligaciones.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes pretensiones
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('pretensiones', [PretensionController::class, 'index'])->name('pretensiones.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes garantias
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('garantias', [GarantiaController::class, 'index'])->name('garantias.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes juzgados
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('juzgados', [JuzgadoController::class, 'index'])->name('juzgados.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes internos (Abogados internos)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('internos', [InternoController::class, 'index'])->name('internos.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes actividades (Actividad procesal)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('actividades', [ActividadController::class, 'index'])->name('actividades.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes externos (Abogados externos)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('externos', [ExternoController::class, 'index'])->name('externos.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes estados (Estado procesal)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('estados', [EstadoController::class, 'index'])->name('estados.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes ubicaciones (Estados de venezuela)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('ubicaciones', [UbicacionController::class, 'index'])->name('ubicaciones.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes juicios (Ficha del juicio)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('juicios', [JuicioController::class, 'index'])->name('juicios.index');
    Route::get('juicios/create', [JuicioController::class, 'create'])->name('juicios.create');
    Route::post('juicios', [JuicioController::class, 'store'])->name('juicios.store');
    Route::get('juicios/{juicio}', [JuicioController::class, 'show'])->name('juicios.show');
    Route::get('juicios/{juicio}/edit', [JuicioController::class, 'edit'])->name('juicios.edit');
    Route::post('juicio/editar/{juicio}', [JuicioController::class, 'update']);
    Route::get('juicio/consulta', [JuicioController::class, 'consulta'])->name('juicios.consulta');
    Route::get('juicio/consultajuicio', [JuicioController::class, 'consultajuicio'])->name('juicios.consultajuicio');
    Route::get('juicio/consultamovimiento', [JuicioController::class, 'consultamovimiento'])->name('juicios.consultamovimiento');
    /* 
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes seguimientos (Seguimiento del juicio)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('seguimientos/{id}', [SeguimientoController::class, 'index'])->name('seguimientos.index');
    Route::get('seguimientos/create/{id}', [SeguimientoController::class, 'create'])->name('seguimientos.create');
    Route::post('seguimientos', [SeguimientoController::class, 'store'])->name('seguimientos.store');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes movimientos (Actividades relacionadas con la ficha del juicio)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('movimientos/{id}', [MovimientoController::class, 'index'])->name('movimientos.index');
    Route::get('movimientos/create/{id}', [MovimientoController::class, 'create'])->name('movimientos.create');
    Route::post('movimientos', [MovimientoController::class, 'store'])->name('movimientos.store');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes agendas (Agenda de las actividades relacionadas a la ficha del juicio)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::resource('agendas', AgendaController::class)->only('index');
    Route::get('agendas/{agenda}/edit', [AgendaController::class, 'edit'])->name('agendas.edit');
    Route::post('agenda/editar/{agenda}', [AgendaController::class, 'update']);
    Route::get('agenda/buscar', [AgendaController::class, 'buscar'])->name('agenda.buscar');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes relaciones (Relación entre juicios)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('relaciones/{id}', [RelacionController::class, 'index'])->name('relaciones.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes datos (Datos extras de la ficha del juicios)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('datos/{id}', [DatoController::class, 'index'])->name('datos.index');
    Route::get('datos/create', [DatoController::class, 'create'])->name('datos.create');
    Route::post('datos', [DatoController::class, 'store'])->name('datos.store');
    Route::get('datos/{dato}/edit', [DatoController::class, 'edit'])->name('datos.edit');
    Route::post('dato/editar/{dato}', [DatoController::class, 'update']);
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes documentos (pagares de la ficha de juicio)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('documentos/{id}', [DocumentoController::class, 'index'])->name('documentos.index');
    Route::get('documentos/create/{id}', [DocumentoController::class, 'create'])->name('documentos.create');
    Route::post('documentos', [DocumentoController::class, 'store'])->name('documentos.store');
    Route::get('documentos/{documento}/edit', [DocumentoController::class, 'edit'])->name('documentos.edit');
    Route::post('documento/editar/{documento}', [DocumentoController::class, 'update']);
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes referencias (datos de las partes actorales de cada ficha de juicio)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('referencias', [ReferenciaController::class, 'index'])->name('referencias.index');
    Route::get('referencias/create', [ReferenciaController::class, 'create'])->name('referencias.create');
    Route::post('referencias', [ReferenciaController::class, 'store'])->name('referencias.store');
    Route::get('referencias/{referencia}/edit', [ReferenciaController::class, 'edit'])->name('referencias.edit');
    Route::post('referencia/editar/{referencia}', [ReferenciaController::class, 'update']);
    Route::get('referencia/consulta', [ReferenciaController::class, 'consulta'])->name('referencias.consulta');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes representantes
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('representantes', [RepresentanteController::class, 'index'])->name('representantes.index');
    Route::get('representantes/create', [RepresentanteController::class, 'create'])->name('representantes.create');
    Route::post('representantes', [RepresentanteController::class, 'store'])->name('representantes.store');
    Route::get('representantes/{representante}/edit', [RepresentanteController::class, 'edit'])->name('representantes.edit');
    Route::post('representante/editar/{representante}', [RepresentanteController::class, 'update']);
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes actores (parte actoral) 
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('actores/{id}/{especialidad}/{representante}', [ActorController::class, 'index'])->name('actores.index');
    Route::get('actores/create/{id}/{especialidad}/{representante}', [ActorController::class, 'create'])->name('actores.create');
    Route::post('actores', [ActorController::class, 'store'])->name('actores.store');
    Route::get('actor/{actor}/edit', [ActorController::class, 'edit'])->name('actor.edit');
    Route::post('actor/editar/{actor}', [ActorController::class, 'update']);
    Route::post('actor/buscar', [ActorController::class, 'buscar'])->name('actores.buscar');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes personas  
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('personas/{id}/{especialidad}/{representante}', [PersonaController::class, 'index'])->name('personas.index');
    Route::get('personas/create/{id}/{especialidad}/{representante}', [PersonaController::class, 'create'])->name('personas.create');
    Route::post('personas', [PersonaController::class, 'store'])->name('personas.store');
    Route::get('persona/{persona}/edit', [PersonaController::class, 'edit'])->name('persona.edit');
    Route::post('persona/editar/{persona}', [PersonaController::class, 'update']);
    Route::get('persona/consulta', [PersonaController::class, 'consulta'])->name('personas.consulta');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes migraciones 
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('migracionesmedida', [MigracionMedidaController::class, 'Medida'])->name('migracionesmedida.medida');
    Route::get('migracionesobligacion', [MigracionObligacionController::class, 'Obligacion'])->name('migracionesobligacion.obligacion');
    Route::get('migracionesgarantia', [MigracionGarantiaController::class, 'Garantia'])->name('migracionesgarantia.garantia');
    Route::get('migracionesinterno', [MigracionInternoController::class, 'Interno'])->name('migracionesinterno.interno');
    Route::get('migracionesjuzgado', [MigracionJuzgadoController::class, 'Juzgado'])->name('migracionesjuzgado.juzgado');
    Route::get('migracionesexterno', [MigracionExternoController::class, 'Externo'])->name('migracionesexterno.externo');
    Route::get('migracionespretension', [MigracionPretensionController::class, 'Pretension'])->name('migracionespretension.pretension');
    Route::get('migracionesestado', [MigracionEstadoController::class, 'Estado'])->name('migracionesestado.estado');
    Route::get('migracionesprocedencia', [MigracionProcedenciaController::class, 'Procedencia'])->name('migracionesprocedencia.procedencia');
    Route::get('migracionesubicacion', [MigracionUbicacionController::class, 'Ubicacion'])->name('migracionesubicacion.ubicacion');
    Route::get('migracionesactividad', [MigracionActividadController::class, 'Actividad'])->name('migracionesactividad.actividad');
    Route::get('migracionesdemanda', [MigracionDemandaController::class, 'Demanda'])->name('migracionesdemanda.demanda');
    Route::get('migracionesfuncionario', [MigracionFuncionarioController::class, 'Funcionario'])->name('migracionesfuncionario.funcionario');
    Route::get('migracionestribunal', [MigracionTribunalController::class, 'Tribunal'])->name('migracionestribunal.tribunal');
    Route::get('migracionesjuicio', [MigracionJuicioController::class, 'Juicio'])->name('migracionesjuicio.juicio');
    Route::get('migracionespersona', [MigracionPersonaController::class, 'Persona'])->name('migracionespersona.persona');
    Route::get('migracionescomodin', [MigracionComodinController::class, 'Comodin'])->name('migracionescomodin.comodin');
    Route::get('migracionesdato', [MigracionDatoController::class, 'Dato'])->name('migracionesdato.dato');
    Route::get('migracionesrelacion', [MigracionRelacionController::class, 'Relacion'])->name('migracionesrelacion.relacion');
    Route::get('migracionesseguimiento', [MigracionSeguimientoController::class, 'Seguimiento'])->name('migracionesseguimiento.seguimiento');
    Route::get('migracionesmovimiento', [MigracionMovimientoController::class, 'Movimiento'])->name('migracionesmovimiento.movimiento');
    Route::get('migracionesagenda', [MigracionAgendaController::class, 'Agenda'])->name('migracionesagenda.agenda');
    Route::get('migracionespagare', [MigracionPagareController::class, 'Pagare'])->name('migracionespagare.pagare');
    Route::get('migracionesabogado', [MigracionAbogadoController::class, 'Abogado'])->name('migracionesabogado.abogado');

    //  Homepage Route - Redirect based on user role is in controller. 
    Route::get('/home', ['as' => 'public.home',   'uses' => 'App\Http\Controllers\UserController@index']);

    // Show users profile - viewable by other users.
    Route::get('profile/{username}', [
        'as'   => '{username}',
        'uses' => 'App\Http\Controllers\ProfilesController@show',
    ]);
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'role:mantenimiento' , 'activity']], function () {

    Route::get('/', InicioController::class)->name('inicio');

    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes tribunales
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('tribunales', [TribunalController::class, 'index'])->name('tribunales.index');
    Route::get('tribunales/create', [TribunalController::class, 'create'])->name('tribunales.create');
    Route::post('tribunales', [TribunalController::class, 'store'])->name('tribunales.store');
    Route::get('tribunales/{tribunal}/edit', [TribunalController::class, 'edit'])->name('tribunales.edit');
    Route::post('tribunal/editar/{tribunal}', [TribunalController::class, 'update']);

    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes estatus 
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('estatus', [EstatuController::class, 'index'])->name('estatus.index');
    Route::get('estatus/create', [EstatuController::class, 'create'])->name('estatus.create');
    Route::post('estatus', [EstatuController::class, 'store'])->name('estatus.store');
    Route::get('estatus/{estatu}/edit', [EstatuController::class, 'edit'])->name('estatus.edit');
    Route::post('estatu/editar/{estatu}', [EstatuController::class, 'update']);
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes procedencias (Bancos en liquidación)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('procedencias', [ProcedenciaController::class, 'index'])->name('procedencias.index');
    Route::get('procedencias/create', [ProcedenciaController::class, 'create'])->name('procedencias.create');
    Route::post('procedencias', [ProcedenciaController::class, 'store'])->name('procedencias.store');
    Route::get('procedencias/{procedencia}/edit', [ProcedenciaController::class, 'edit'])->name('procedencias.edit');
    Route::post('procedencia/editar/{procedencia}', [ProcedenciaController::class, 'update']);
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes especialidades (Ramas del juicio)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('especialidades', [EspecialidadController::class, 'index'])->name('especialidades.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes configuraciones (Configurar la especialidad o rama del juicio)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('configuraciones', [ConfiguracionController::class, 'index'])->name('configuraciones.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes demandas (tipo de proceso)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('demandas', [DemandaController::class, 'index'])->name('demandas.index');
    Route::get('demandas/create', [DemandaController::class, 'create'])->name('demandas.create');
    Route::post('demandas', [DemandaController::class, 'store'])->name('demandas.store');
    Route::get('demandas/{demanda}/edit', [DemandaController::class, 'edit'])->name('demandas.edit');
    Route::post('demanda/editar/{demanda}', [DemandaController::class, 'update']);
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes tipos de documentos 
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('tipos', [TipoController::class, 'index'])->name('tipos.index');
    Route::get('tipos/create', [TipoController::class, 'create'])->name('tipos.create');
    Route::post('tipos', [TipoController::class, 'store'])->name('tipos.store');
    Route::get('tipos/{tipo}/edit', [TipoController::class, 'edit'])->name('tipos.edit');
    Route::post('tipo/editar/{tipo}', [TipoController::class, 'update']);
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes medidas
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('medidas', [MedidaController::class, 'index'])->name('medidas.index');
    Route::get('medidas/create', [MedidaController::class, 'create'])->name('medidas.create');
    Route::post('medidas', [MedidaController::class, 'store'])->name('medidas.store');
    Route::get('medidas/{medida}/edit', [MedidaController::class, 'edit'])->name('medidas.edit');
    Route::post('medida/editar/{medida}', [MedidaController::class, 'update']);
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes obligaciones
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('obligaciones', [ObligacionController::class, 'index'])->name('obligaciones.index');
    Route::get('obligaciones/create', [ObligacionController::class, 'create'])->name('obligaciones.create');
    Route::post('obligaciones', [ObligacionController::class, 'store'])->name('obligaciones.store');
    Route::get('obligaciones/{obligacion}/edit', [ObligacionController::class, 'edit'])->name('obligaciones.edit');
    Route::post('obligacion/editar/{obligacion}', [ObligacionController::class, 'update']);
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes pretensiones
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('pretensiones', [PretensionController::class, 'index'])->name('pretensiones.index');
    Route::get('pretensiones/create', [PretensionController::class, 'create'])->name('pretensiones.create');
    Route::post('pretensiones', [PretensionController::class, 'store'])->name('pretensiones.store');
    Route::get('pretensiones/{pretension}/edit', [PretensionController::class, 'edit'])->name('pretensiones.edit');
    Route::post('pretension/editar/{pretension}', [PretensionController::class, 'update']);
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes garantias
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('garantias', [GarantiaController::class, 'index'])->name('garantias.index');
    Route::get('garantias/create', [GarantiaController::class, 'create'])->name('garantias.create');
    Route::post('garantias', [GarantiaController::class, 'store'])->name('garantias.store');
    Route::get('garantias/{garantia}/edit', [GarantiaController::class, 'edit'])->name('garantias.edit');
    Route::post('garantia/editar/{garantia}', [GarantiaController::class, 'update']);
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes juzgados
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('juzgados', [JuzgadoController::class, 'index'])->name('juzgados.index');
    Route::get('juzgados/create', [JuzgadoController::class, 'create'])->name('juzgados.create');
    Route::post('juzgados', [JuzgadoController::class, 'store'])->name('juzgados.store');
    Route::get('juzgados/{juzgado}/edit', [JuzgadoController::class, 'edit'])->name('juzgados.edit');
    Route::post('juzgado/editar/{juzgado}', [JuzgadoController::class, 'update']);
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes internos (Abogados internos)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('internos', [InternoController::class, 'index'])->name('internos.index');
    Route::get('internos/create', [InternoController::class, 'create'])->name('internos.create');
    Route::post('internos', [InternoController::class, 'store'])->name('internos.store');
    Route::get('internos/{interno}/edit', [InternoController::class, 'edit'])->name('internos.edit');
    Route::post('interno/editar/{interno}', [InternoController::class, 'update']);
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes actividades (Actividad procesal)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('actividades', [ActividadController::class, 'index'])->name('actividades.index');
    Route::get('actividades/create', [ActividadController::class, 'create'])->name('actividades.create');
    Route::post('actividades', [ActividadController::class, 'store'])->name('actividades.store');
    Route::get('actividades/{actividad}/edit', [ActividadController::class, 'edit'])->name('actividades.edit');
    Route::post('actividad/editar/{actividad}', [ActividadController::class, 'update']);
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes externos (Abogados externos)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('externos', [ExternoController::class, 'index'])->name('externos.index');
    Route::get('externos/create', [ExternoController::class, 'create'])->name('externos.create');
    Route::post('externos', [ExternoController::class, 'store'])->name('externos.store');
    Route::get('externos/{externo}/edit', [ExternoController::class, 'edit'])->name('externos.edit');
    Route::post('externo/editar/{externo}', [ExternoController::class, 'update']);
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes estados (Estado procesal)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('estados', [EstadoController::class, 'index'])->name('estados.index');
    Route::get('estados/create', [EstadoController::class, 'create'])->name('estados.create');
    Route::post('estados', [EstadoController::class, 'store'])->name('estados.store');
    Route::get('estados/{estado}/edit', [EstadoController::class, 'edit'])->name('estados.edit');
    Route::post('estado/editar/{estado}', [EstadoController::class, 'update']);
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes ubicaciones (Estados de venezuela)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('ubicaciones', [UbicacionController::class, 'index'])->name('ubicaciones.index');
    Route::get('ubicaciones/create', [UbicacionController::class, 'create'])->name('ubicaciones.create');
    Route::post('ubicaciones', [UbicacionController::class, 'store'])->name('ubicaciones.store');
    Route::get('ubicaciones/{ubicacion}/edit', [UbicacionController::class, 'edit'])->name('ubicaciones.edit');
    Route::post('ubicacion/editar/{ubicacion}', [UbicacionController::class, 'update']);

    //  Homepage Route - Redirect based on user role is in controller. 
    Route::get('/home', ['as' => 'public.home',   'uses' => 'App\Http\Controllers\UserController@index']);

    // Show users profile - viewable by other users.
    Route::get('profile/{username}', [
        'as'   => '{username}',
        'uses' => 'App\Http\Controllers\ProfilesController@show',
    ]);
});




// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'role:consulta'  , 'activity']], function () {

    Route::get('/', InicioController::class)->name('inicio');
    Route::get('registrostribunales/{id}',  [TribunalController::class, 'byJuzgado'])->name('registrostribunales');
    Route::get('registrosjuzgados/{id}',  [JuzgadoController::class, 'byTribunal'])->name('registrosjuzgados');

    Route::get('todosjuzgados',  [JuzgadoController::class, 'allJuzgados'])->name('todosjuzgados');


    //Route::get('registrospersonas/{juicio_id}/{tipo}',  [PersonaController::class,'byPersona'])->name('registrospersonas');
    Route::get('registrosestatus/{terminado}',  [EstatuController::class, 'byEstatu'])->name('registrosestatus}');
    Route::get('buscarestatu/{id}',  [EstatuController::class, 'byBuscarEstatu'])->name('buscarestatu}');
    Route::get('registrosabogados/{juicio_id}',  [AbogadoController::class, 'byAbogados'])->name('registrosabogados');
    //Route::get('demandado/{id}', [PersonaController::class, 'edit'])->name('demandado.edit');
    //Route::post('demandado/{id}', [PersonaController::class, 'update'])->name('demandado.update');
    //Route::get('demandante/{id}', [PersonaController::class, 'edit'])->name('demandante.edit');
    //Route::post('demandante/{id}', [PersonaController::class, 'update'])->name('demandante.update');
    Route::get('registrosespecialidades/{id}',  [EspecialidadController::class, 'byInternacional'])->name('registrosespecialidades');
    Route::get('registrosconfiguraciones/{id}',  [ConfiguracionController::class, 'byEspecialidad'])->name('registrosconfiguraciones');


    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes juicios (Ficha del juicio)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('juicios', [JuicioController::class, 'index'])->name('juicios.index');
    Route::get('juicio/consulta', [JuicioController::class, 'consulta'])->name('juicios.consulta');
    Route::get('juicio/consultajuicio', [JuicioController::class, 'consultajuicio'])->name('juicios.consultajuicio');
    Route::get('juicio/consultamovimiento', [JuicioController::class, 'consultamovimiento'])->name('juicios.consultamovimiento');
    /* 
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes seguimientos (Seguimiento del juicio)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('seguimientos/{id}', [SeguimientoController::class, 'index'])->name('seguimientos.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes movimientos (Actividades relacionadas con la ficha del juicio)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('movimientos/{id}', [MovimientoController::class, 'index'])->name('movimientos.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes agendas (Agenda de las actividades relacionadas a la ficha del juicio)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    //$fecha = Carbon::now();
    Route::resource('agendas', AgendaController::class)->only('index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes relaciones (Relación entre juicios)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('relaciones/{id}', [RelacionController::class, 'index'])->name('relaciones.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes datos (Datos extras de la ficha del juicios)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('datos/{id}', [DatoController::class, 'index'])->name('datos.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes abogados (Asiganar abogado interno al juicio)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('abogados/{id}', [AbogadoController::class, 'index'])->name('abogados.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes documentos (pagares de la ficha de juicio)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('documentos/{id}', [DocumentoController::class, 'index'])->name('documentos.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes referencias (datos de las partes actorales de cada ficha de juicio)
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('referencias', [ReferenciaController::class, 'index'])->name('referencias.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes representantes
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('representantes', [RepresentanteController::class, 'index'])->name('representantes.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes actores (parte actoral) 
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('actores/{id}/{especialidad}/{representante}', [ActorController::class, 'index'])->name('actores.index');
    /*
    |-------------------------------------------------------------------------------------------------------------------------------------------
    | Web Routes personas  
    |-------------------------------------------------------------------------------------------------------------------------------------------
    */
    Route::get('personas/{id}/{especialidad}/{representante}', [PersonaController::class, 'index'])->name('personas.index');


    //  Homepage Route - Redirect based on user role is in controller. 
    Route::get('/home', ['as' => 'public.home',   'uses' => 'App\Http\Controllers\UserController@index']);

    // Show users profile - viewable by other users.
    Route::get('profile/{username}', [
        'as'   => '{username}',
        'uses' => 'App\Http\Controllers\ProfilesController@show',
    ]);
});




// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'twostep']], function () {

    //  Homepage Route - Redirect based on user role is in controller.
    Route::get('/home', ['as' => 'public.home',   'uses' => 'App\Http\Controllers\UserController@index']);

    // Show users profile - viewable by other users.
    Route::get('profile/{username}', [
        'as'   => '{username}',
        'uses' => 'App\Http\Controllers\ProfilesController@show',
    ]);
});

// Registered, activated, and is current user routes.
Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'activity', 'twostep']], function () {

    // User Profile and Account Routes
    Route::resource(
        'profile',
        \App\Http\Controllers\ProfilesController::class,
        [
            'only' => [
                'show',
                'edit',
                'update',
                'create',
            ],
        ]
    );
    Route::put('profile/{username}/updateUserAccount', [
        'as'   => '{username}',
        'uses' => 'App\Http\Controllers\ProfilesController@updateUserAccount',
    ]);
    Route::put('profile/{username}/updateUserPassword', [
        'as'   => '{username}',
        'uses' => 'App\Http\Controllers\ProfilesController@updateUserPassword',
    ]);
    Route::delete('profile/{username}/deleteUserAccount', [
        'as'   => '{username}',
        'uses' => 'App\Http\Controllers\ProfilesController@deleteUserAccount',
    ]);

    // Route to show user avatar
    Route::get('images/profile/{id}/avatar/{image}', [
        'uses' => 'App\Http\Controllers\ProfilesController@userProfileAvatar',
    ]);

    // Route to upload user avatar.
    Route::post('avatar/upload', ['as' => 'avatar.upload', 'uses' => 'App\Http\Controllers\ProfilesController@upload']);
});

// Registered, activated, and is admin routes. 
Route::group(['middleware' => ['auth', 'activated', 'role:admin', 'activity', 'twostep']], function () {
    Route::resource('/users/deleted', \App\Http\Controllers\SoftDeletesController::class, [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);

    Route::resource('users', \App\Http\Controllers\UsersManagementController::class, [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::post('search-users', 'App\Http\Controllers\UsersManagementController@search')->name('search-users');

    Route::resource('themes', \App\Http\Controllers\ThemesManagementController::class, [
        'names' => [
            'index'   => 'themes',
            'destroy' => 'themes.destroy',
        ],
    ]);

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('routes', 'App\Http\Controllers\AdminDetailsController@listRoutes');
    Route::get('active-users', 'App\Http\Controllers\AdminDetailsController@activeUsers');
});

Route::redirect('/php', '/phpinfo', 301);

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
