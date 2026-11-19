<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// ----------------------------------------------------
// مسارات إدارة المهام (Tasks)
// ----------------------------------------------------
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/create', [TaskController::class, 'store'])->name('tasks.store');
Route::post('/delete/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::post('/edit/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
Route::post('/update', [TaskController::class, 'update'])->name('tasks.update');

// ----------------------------------------------------
// مسارات إدارة المستخدمين (Users)
// ----------------------------------------------------
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
