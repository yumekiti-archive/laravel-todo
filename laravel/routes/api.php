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
    Route::apiResource('todo', TodoController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);
    Route::apiResource('user', UserController::class)->only([
        'store', 'update', 'destroy'
    ]);
});

Route::apiResource('users', TodoController::class)->only([
    'store'
]);

Route::post('/login', [TodoController::class, 'login']);