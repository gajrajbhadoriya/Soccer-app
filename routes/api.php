<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * its teams Apis
 */
Route::post('/teams', [TeamController::class, 'store']);
Route::get('/teams', [TeamController::class, 'index']);
Route::get('/teams/{team_id}', [TeamController::class, 'show']);
Route::put('/teams/{id}', [TeamController::class, 'update']);
Route::delete('/teams/{id}', [TeamController::class, 'destroy']);
// Route::resource('/teams',PlayerController::class);

/**
 * its Player Apis
 */

Route::post('/players', [PlayerController::class, 'store']);
Route::get('/players', [PlayerController::class, 'index']);
Route::get('/players/{player_id}', [PlayerController::class, 'show']);
Route::put('/players/{id}', [PlayerController::class, 'update']);
Route::delete('/players/{id}', [PlayerController::class, 'destroy']);
Route::get('/players/teams/{id}',[PlayerController::class, 'teamsPlayer']);
// Route::resource('/players/{id}',PlayerController::class);

