<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

// 1. عرض الصفحة مع جميع المهام (الجزء الثالث)
Route::get('/tasks', function () {
    $tasks = DB::table('tasks')->get();
    return view('tasks', compact('tasks'));
});

// 2. إضافة مهمة جديدة
Route::post('/create', function () {
    $task_name = request('name');

    DB::table('tasks')->insert([
        'name' => $task_name
    ]);

    return redirect('/tasks');
});

// 3. حذف مهمة محددة (الجزء الرابع)
Route::post('/delete/{id}', function ($id) {
    DB::table('tasks')->where('id', $id)->delete();
    return redirect('/tasks');
});

// 4. جلب بيانات المهمة لوضعها في فورم التعديل (الجزء الخامس)
Route::post('/edit/{id}', function ($id) {
    $task = DB::table('tasks')->where('id', $id)->first();
    $tasks = DB::table('tasks')->get();
    return view('tasks', compact('task', 'tasks'));
});

// 5. حفظ التعديلات في قاعدة البيانات (الجزء الخامس)
Route::post('/update', function () {
    $id = request('id');
    $name = request('name');

    DB::table('tasks')->where('id', $id)->update([
        'name' => $name
    ]);

    return redirect('/tasks');
});
