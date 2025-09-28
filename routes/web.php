<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskStatusController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');




    Route::resource('users', \App\Http\Controllers\UserController::class)->except(['show']);
    Route::resource('roles', \App\Http\Controllers\RoleController::class)->except(['show']);
    Route::resource('projects', \App\Http\Controllers\ProjectController::class)->except(['show']);
   
    Route::resource('tasks', \App\Http\Controllers\TaskController::class)->except(['show']);


      Route::post('/tasks/{id}/approve',[TaskController::class,'approve']);
     Route::get('/dashboard',[TaskController::class,'myTasks']);
    Route::post('/tasks/{id}/complete',[TaskController::class,'complete']);