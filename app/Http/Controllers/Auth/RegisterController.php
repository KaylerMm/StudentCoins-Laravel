<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Wallet;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function showStudentRegisterForm()
    {
        return view('auth.register-student');
    }

    public function registerStudent(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'turma' => 'required|string|max:50',
            'curso' => 'required|string|max:100',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'student',
        ]);

        Student::create([
            'user_id' => $user->id,
            'turma' => $data['turma'],
            'curso' => $data['curso'],
        ]);

        Wallet::create([
            'user_id' => $user->id,
            'balance' => 0,
        ]);

        // Automatically log in the user after registration
        auth()->login($user);

        return redirect()->route('dashboard.student');
    }
}
