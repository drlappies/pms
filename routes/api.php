<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectUserController;
use App\Http\Controllers\SubtaskController;
use App\Http\Controllers\SubtaskUserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskUserController;


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

Route::get('/project/{projectid}/task', [TaskController::class, 'getall']);
Route::get('/project/{projectid}/task/{id}', [TaskController::class, 'getone']);
Route::post('/project/{projectid}/task', [TaskController::class, 'create']);
Route::put('/project/{projectid}/task/{id}', [TaskController::class, 'update']);
Route::delete('/project/{projectid}/task/{id}', [TaskController::class, 'destroy']);

Route::post('/project/{projectid}/task/{taskid}/user/{userid}', [TaskUserController::class, 'assign']);
Route::delete('/project/{projectid}/task/{taskid}/user/{userid}', [TaskUserController::class, 'unassign']);

Route::get('/task/{taskid}/subtask', [SubtaskController::class, 'getall']);
Route::get('/task/{taskid}/subtask/{subtaskid}', [SubtaskController::class, 'getone']);
Route::post('/task/{taskid}/subtask', [SubtaskController::class, 'create']);
Route::put('/task/{taskid}/subtask/{subtaskid}', [SubtaskController::class, 'update']);
Route::delete('/task/{taskid}/subtask/{subtaskid}', [SubtaskController::class, 'destroy']);

Route::post('/task/{taskid}/subtask/{subtaskid}/user/{userid}', [SubtaskUserController::class, 'assign']);
Route::delete('/task/{taskid}/subtask/{subtaskid}/user/{userid}', [SubtaskUserController::class, 'unassign']);