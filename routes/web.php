<?php

use Illuminate\Support\Facades\Route;

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
    return 'API BLIP V1';
});



Route::post('/register', 'JwtController@register');
Route::post('/login', 'JwtController@authenticate');



Route::prefix('v1')->group(function () {

    Route::prefix('usuario')->group(function () {      
        Route::post('tipodocumento/listar', 'UsuarioController@listarTipoDocumento');
        Route::post('tipogenero/listar', 'UsuarioController@listarTipoGenero');
        Route::post('registrar', 'UsuarioController@registrarUsuario');
    });
    



    Route::group(
        ['middleware' => ['jwt.verify']],
        function () {
            Route::post('token-validate', 'JwtController@tokenValidation');

        }
    );




});
