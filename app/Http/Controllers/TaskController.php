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

    public function edit($id)
    {
        $tasks = session()->get('tasks', []);
        $task = null;

        foreach ($tasks as $item) {
            $itemId = is_array($item) ? ($item['id'] ?? null) : ($item->id ?? null);
            if ((string) $itemId === (string) $id) {
                $task = $item;
                break;
            }
        }

        if (!$task) {
            return redirect('/tasks');
        }

        return view('users.tasks', compact('tasks', 'task'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required|string|max:255',
        ]);

        $tasks = session()->get('tasks', []);

        foreach ($tasks as &$item) {
            $itemId = is_array($item) ? ($item['id'] ?? null) : ($item->id ?? null);
            if ((string) $itemId === (string) $request->id) {
                if (is_array($item)) {
                    $item['name'] = $request->name;
                } elseif (is_object($item)) {
                    $item->name = $request->name;
                }
                break;
            }
        }
        unset($item);

        session()->put('tasks', $tasks);

        return redirect('/tasks');
    }

    public function destroy($id)
    {
        $tasks = session()->get('tasks', []);

        $tasks = array_values(array_filter($tasks, function ($task) use ($id) {
            $taskId = is_array($task) ? ($task['id'] ?? null) : ($task->id ?? null);
            return (string) $taskId !== (string) $id;
        }));

        foreach ($tasks as $index => &$task) {
            if (is_array($task)) {
                $task['id'] = $index + 1;
            } elseif (is_object($task)) {
                $task->id = $index + 1;
            }
        }
        unset($task);

        session()->put('tasks', $tasks);

        return redirect('/tasks');
    }
}
