<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = session()->get('tasks', []);
        return view('users.tasks', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tasks = session()->get('tasks', []);
        $tasks[] = [
            'id' => count($tasks) + 1,
            'name' => $request->name,
        ];

        session()->put('tasks', $tasks);

        return redirect('/tasks');
    }
}
