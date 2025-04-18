<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\EstudiantesController;

// Ruta de prueba
//obtener todos los estudiantes
Route::get('/estudiantes',[EstudiantesController::class,'index']);



Route::get('/estudiantes/{id}',[EstudiantesController::class,'show']);

//crear un estudiante
Route::post('/estudiantes',[EstudiantesController::class,'store']);

//crear un estudiante


//actualizar  un estudiante
Route::put('/estudiantes/{id}',[EstudiantesController::class,'update']);

//actualizar  un estudiante campo especifico
Route::patch('/estudiantes/{id}',[EstudiantesController::class,'patch']);

//eliminar  un estudiante
Route::delete('/estudiantes/{id}',[EstudiantesController::class,'destroy']);





