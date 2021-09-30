<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectUserController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user', [UserController::class, 'getall']);
Route::get('/user/{id}', [UserController::class, 'getone']);
Route::post('/user', [UserController::class, 'create']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);

Route::get('/project', [ProjectController::class, 'getall']);
Route::get('/project/{id}', [ProjectController::class, 'getone']);
Route::post('/project', [ProjectController::class, 'create']);
Route::put('/project/{id}',  [ProjectController::class, 'update']);
Route::delete('/project/{id}',  [ProjectController::class, 'destroy']);

Route::post('/project/{projectid}/user/{userid}', [ProjectUserController::class, 'assign']);
Route::delete('/project/{projectid}/user/{userid}', [ProjectUserController::class, 'unassign']);
