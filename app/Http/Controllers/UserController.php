<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {

        // 1. Cari employee berdasarkan name dan email
        $employee = Employee::where('name', $request->name)
            ->where('email', $request->email)
            ->first();
        // dd($request);
        if (!$employee) {
            return redirect()->back()->with('error', 'Employee tidak ditemukan.');
        }

        // 2. Input data ke tabel users
        $user = User::create([
            'name' => $employee->name,
            'email' => $employee->email,
            'password' => bcrypt($request->password),
            'email_verified_at' => DB::raw('NOW()'),
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        // 3. Dapatkan ID user yang baru saja diinput
        $userId = $user->id;

        // 4. Update login_id di tabel employees
        $employee->update([
            'login_id' => $userId
        ]);


        return redirect()->route('users.index')->with('success', 'Employee created successfully.');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // 1. Cari user berdasarkan name dan email
        $user = User::where('name', $request->name)
            ->where('email', $request->email)
            ->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        // 2. Update user jika diperlukan (contoh: update password)
        $user->update([
            'password' => bcrypt($request->password),
            'updated_at' => DB::raw('NOW()')
        ]);

        // 3. Update kolom login_id di tabel employees
        $employee = Employee::where('name', $request->name)
            ->where('email', $request->email)
            ->first();

        if ($employee) {
            $employee->update([
                'login_id' => $user->id
            ]);

            return redirect()->route('users.index')->with('success', 'User updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Employee tidak ditemukan.');
        }

        
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
