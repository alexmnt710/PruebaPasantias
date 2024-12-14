<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ReservationController;


Route::post ( '/filterProperties' , [PropertyController :: class , 'filterProperties' ]);


// Middleware para usuarios invitados (no autenticados)
Route::middleware('guest.custom')->group(function () {
    Route::get('/example', function () {
        return response()->json(['message' => 'CORS working!']);
    });
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/getUsers', [UserController::class, 'getUsers']);
    Route :: get ( '/getProperties' , [PropertyController :: class , 'getProperties' ]);

    Route::get('/checkSession', [AuthController::class, 'checkSession']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/makeReservation', [ReservationController::class, 'makeReservation']);
    Route::post('/getUserReservations', [ReservationController::class, 'getUserReservations']);

});


// Middleware para roles de usuario
Route::middleware(['auth:sanctum', 'role:user'])->group(function () {
    Route::get('/user', function () {
        return response()->json(['message' => 'Bienvenido, Usuario']);
    });
});
