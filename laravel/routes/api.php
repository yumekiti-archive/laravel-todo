<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/todo/trashed', [TodoController::class, 'trashed']);
    Route::delete('/todo/forceDelete/{id}', [TodoController::class, 'forceDelete']);
    Route::get('/todo/restore/{id}', [TodoController::class, 'restore']);

    Route::apiResource('todo', TodoController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    Route::apiResource('user', UserController::class)->only([
        'index', 'update', 'destroy'
    ]);
});

Route::apiResource('user', UserController::class)->only([
    'store'
]);

Route::post('/login', [UserController::class, 'login']);

Route::get('/', function () {
    return 'Hello World';
});