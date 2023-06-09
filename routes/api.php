<?php

use App\Http\Controllers\AlumnosController;
use App\Http\Controllers\NotasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('alumnos', AlumnosController::class);
Route::resource('notas', NotasController::class);