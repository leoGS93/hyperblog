<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\api\EmpresaClienteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => [], 'prefix' => 'v1'], function () {
     Route::post('login',[AuthController::class, "login"]);
});

Route::group(['middleware' => ['jwt.auth'], 'prefix' => 'v1'], function () {

    Route::post('logout', [AuthController::class, "logout"]);
    Route::post('refresh', [AuthController::class, "refresh"]);
    Route::get('me',[AuthController::class, "me"]);
    Route::put('me/edit',[AuthController::class, "meedit"]);
    


    Route::get('tipos-sangre', 'Api\barritan\TipoSangreController@index');
    Route::get('tipos-empleados', 'Api\barritan\TipoEmpleadoController@index');

    Route::resource('/users', 'api\barritan\UserController')->only(['index','store']);\
    Route::put('users/{id}','api\barritan\UserController@actualizar');

    Route::resource('/empresas',EmpresaClienteController::class);
    Route::put('clientes/{id}','api\barritan\ClienteController@actualizar');
    

    Route::resource('/empleados', 'api\barritan\EmpleadoController')->only(['index','store','show']);
    Route::put('empleados/{id}','api\barritan\EmpleadoController@actualizar');

    Route::resource('/productos', 'api\barritan\ProductoController')->only(['index','store','show']);
    Route::put('productos/{id}','api\barritan\ProductoController@actualizar');

    Route::resource('/dotaciones', 'api\barritan\DotacionesEmpleadosController')->only(['index','store','show']);
    Route::put('dotaciones/{id}','api\barritan\DotacionesEmpleadosController@actualizar');
    Route::get('empleados/dotaciones/{id}','api\barritan\DotacionesEmpleadosController@empleadosDotaciones');
});
