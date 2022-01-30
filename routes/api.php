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


Route::post('/create', [App\Http\Controllers\CrudController::class, 'store']);
Route::get('/readone/{id}', [App\Http\Controllers\CrudController::class, 'getOne']);
Route::get('/read', [App\Http\Controllers\CrudController::class, 'getAll']);
Route::post('/update', [App\Http\Controllers\CrudController::class, 'updateRecord']);
Route::post('/delete', [App\Http\Controllers\CrudController::class, 'deleteRecord']);
