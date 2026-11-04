<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

// مسار عرض صفحة المهام
Route::get('/tasks', function () {
    return view('tasks');
});

// مسار استقبال البيانات وحفظها في قاعدة البيانات
Route::post('/create', function () {
    $task_name = request('name');

    DB::table('tasks')->insert([
        'name' => $task_name
    ]);

    return redirect('/tasks');
});
