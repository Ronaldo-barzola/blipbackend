<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\SaldosController;


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

Route::get('/', function () {
    return 'API SALDOS - V1';
});

Route::get('/phpinfo', function () {
    return phpinfo();
});

Route::prefix('v1')->group(function () {
    Route::prefix('usuario')->group(function () {
        Route::post('login', [UsuarioController::class, 'login']);
        Route::post('accesoIns', [UsuarioController::class, 'usuarioAccesoIns']);
        Route::post('entidad/listar', [UsuarioController::class, 'entidadSel']);
    });
    Route::prefix('saldos')->group(function () {
        Route::post('dashboard01', [SaldosController::class, 'dashboard01']);
        Route::post('dashboard02', [SaldosController::class, 'dashboard02']);
        Route::post('dashboard03', [SaldosController::class, 'dashboard03']);
        Route::post('dashboard04', [SaldosController::class, 'dashboard04']);
        Route::post('loteContribuyente/registrar', [SaldosController::class, 'loteContribuyenteIns']);
        Route::post('loteContribuyente/listar', [SaldosController::class, 'loteContribuyenteSel']);
        Route::post('loteContribuyenteDetalle/registrar', [SaldosController::class, 'loteContribuyenteDetalleIns']);
        Route::post('loteContribuyenteDetalle/listar', [SaldosController::class, 'loteContribuyenteDetalleSel']);
        Route::post('loteContribuyente/procesar', [SaldosController::class, 'loteContribuyenteProcesar']);
        Route::post('loteControl/listar', [SaldosController::class, 'loteControlSaldos']);
        Route::post('planilla/listar', [SaldosController::class, 'planillaSel']);
        Route::post('planillaDetalle/listar', [SaldosController::class, 'planillaDetalleSel']);
        Route::post('segmento/listar', [SaldosController::class, 'segmentoSel']);
        // Route::post('segmento/listar', [SaldosController::class, 'segmentoSel']);
        
        Route::post('planillaProcesoPaginado/listar', [SaldosController::class, 'planillaDetalleProcesoSelPaginado']);
        Route::post('planillaProcesoTotalPaginas/listar', [SaldosController::class, 'planillaProcesoTotalFilas']);
        Route::get('eecc/detallado', [SaldosController::class, 'reporteDetallado']);
        Route::get('eecc/resumen', [SaldosController::class, 'reporteResumido']);

        Route::get('planillaProceso/exportarCsv', [SaldosController::class, 'planillaProcesoCsv']);
        Route::get('planillaProceso/exportarXls', [SaldosController::class, 'planillaProcesoXls']);
        

    });

});

Route::prefix('usuario')->group(function () {
    Route::post('registrar-usuario', 'UsuarioController@registrarUsuario');
    Route::post('listar-usuario', 'UsuarioController@listarUsuario');
    Route::post('desactivar-usuario', 'UsuarioController@desactivarUsuario');
    Route::post('listar-perfil', 'UsuarioController@listarPerfil');
    Route::post('registrar-perfil', 'UsuarioController@guardarPerfil');
    Route::post('listar-aplicacion', 'UsuarioController@listarAplicacion');
    Route::post('registrar-aplicacion', 'UsuarioController@registrarAplicacion');
    Route::post('registrar-aplicacion-perfil', 'UsuarioController@registrarAplicacionPerfil');
    Route::post('listar-aplicacion-perfil', 'UsuarioController@listarAplicacionPerfil');
    Route::post('acceso', 'UsuarioController@accesoChk');
});

Route::prefix('persona')->group(function () {
    Route::post('listar-tipo-documento', 'PersonaController@listarTipoDocumento');
    Route::post('listar-persona', 'PersonaController@listarPersonaNatural');
    Route::post('guardar-persona', 'PersonaController@desactivarUsuario');
});

Route::prefix('v1')->group(function () {
    Route::post('vcard-member', 'VCardController@vCardMemberSearch');
    Route::post('contact-message', 'MailingController@webSendContactMail');
    Route::post('add-subscriber', 'SubscriptionController@addSubscriber');
});

