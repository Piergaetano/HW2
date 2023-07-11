<?php

use Illuminate\Support\Facades\Route;
/*Piergaetano Di Vita O46001380*/

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
*/

Route::get('/', function () {
    return redirect('login');
});

/*-------------------------------------------SIGNUP---------------------------------------------*/
Route::get('register','App\Http\Controllers\RegisterController@register_form');
Route::post('register','App\Http\Controllers\RegisterController@do_register');

/*-------------------------------------------LOGIN---------------------------------------------*/
Route::get('login','App\Http\Controllers\LoginController@mostra_login');
Route::post('login','App\Http\Controllers\LoginController@effettua_login');
Route::get('logout','App\Http\Controllers\LogoutController@effettua_logout');

/*-------------------------------------------PROFILO---------------------------------------------*/
Route::get('profilo', 'App\Http\Controllers\ProfiloController@mostra_profilo');
Route::post('profilo_modificaPassword', 'App\Http\Controllers\ProfiloController@modifica_password');
Route::post('profilo_modificaFoto', 'App\Http\Controllers\ProfiloController@modifica_foto');
Route::post('profilo_modificaCopertina', 'App\Http\Controllers\ProfiloController@modifica_copertina');

/*-------------------------------------------CERCA---------------------------------------------*/
Route::get('cerca','App\Http\Controllers\CercaController@mostra_cerca');
Route::get('Api_private_gestisci','App\Http\Controllers\CercaController@gestisci_preferiti');

/*-------------------------------------------HOME---------------------------------------------*/
Route::get('home','App\Http\Controllers\CollectionController@mostra_home');
Route::get('carica_film','App\Http\Controllers\CollectionController@carica_film');

