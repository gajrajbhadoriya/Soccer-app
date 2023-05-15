<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/**
 * its teams Apis
 */
Route::get('/teams', [TeamController::class, 'index']);
Route::get('/teams/{team_id}', [TeamController::class, 'show']);
// Route::resource('/teams',PlayerController::class);

/**
 * its Player Apis
 */

Route::get('/players', [PlayerController::class, 'index']);
Route::get('/players/{player_id}', [PlayerController::class, 'show']);
Route::get('/players/teams/{id}', [PlayerController::class, 'teamsPlayer']);
// Route::resource('/players/{id}',PlayerController::class);

Route::group(['middleware' => ['auth:sanctum', 'App\Http\Middleware\AdminAuth']], function () {
    Route::put('/teams/{id}', [TeamController::class, 'update']);
    Route::delete('/teams/{id}', [TeamController::class, 'destroy']);
    Route::post('/teams', [TeamController::class, 'store']);
    Route::post('/players', [PlayerController::class, 'store']);
    Route::put('/players/{id}', [PlayerController::class, 'update']);
    Route::delete('/players/{id}', [PlayerController::class, 'destroy']);
    Route::get('test-safe', [TeamController::class, 'testSafe']);
});

Route::get('unauth-response', [TeamController::class, 'unauthResponse'])->name('login');
