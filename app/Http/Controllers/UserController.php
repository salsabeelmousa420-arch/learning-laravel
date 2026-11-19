<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // 1. استعراض جميع المستخدمين
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // 2. عرض نموذج إضافة مستخدم جديد
    public function create()
    {
        return view('users.create');
    }

    // 3. تخزين المستخدم الجديد في قاعدة البيانات
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'تم إضافة المستخدم بنجاح');
    }

    // 4. عرض نموذج تعديل بيانات المستخدم
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // 5. تحديث بيانات المستخدم
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('users.index')->with('success', 'تم تحديث البيانات بنجاح');
    }

    // 6. حذف المستخدم
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users.index')->with('success', 'تم حذف المستخدم بنجاح');
    }
}
