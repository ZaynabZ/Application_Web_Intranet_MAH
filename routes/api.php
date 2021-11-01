<?php

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::delete('/reservations/{reservation_time}', [ReservationController::class, 'destroy']);

Route::post('/reservations', [ReservationController::class, 'store']);

//Route::get('/users/update/{id}', [UserController::class, 'updateUser']);
Route::post('/users/update/{id}', [UserController::class, 'updateUser']);

Route::get('/reservations', [ReservationController::class, 'index']);
Route::get('/reservations/{user_id}', [ReservationController::class, 'show']);

Route::post('/update_password', [UserController::class, 'updatePassword']);