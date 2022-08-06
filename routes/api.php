<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::resource('agences', App\Http\Controllers\AgenceController::class);
Route::resource('clients', App\Http\Controllers\ClientController::class);
Route::resource('comptecourants', App\Http\Controllers\ComptecourantController::class);
Route::resource('compteepargnes', App\Http\Controllers\CompteepargneController::class);

Route::post('/faireDepot',[\App\Http\Controllers\TransactionController::class, 'faireDepot']);
Route::post('/faireRetrait',[\App\Http\Controllers\TransactionController::class, 'faireRetrait']);
