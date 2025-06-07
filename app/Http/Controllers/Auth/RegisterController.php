<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Partner;
use App\Models\Wallet;
use App\Enums\UserRoles;
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
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => ['required', 'confirmed', Password::defaults()],
                'class' => 'required|string|max:50',
                'course' => 'required|string|max:100',
            ]);
    
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => UserRoles::STUDENT->value,
            ]);
    
            Student::create([
                'user_id' => $user->id,
                'class' => $data['class'],
                'course' => $data['course'],
            ]);
    
            Wallet::create([
                'user_id' => $user->id,
                'balance' => 0,
            ]);
    
            // Automatically log in the user after registration
            auth()->login($user);
            return redirect()->route('dashboard.student');
        }
        catch (\Exception $e) {
            \Log::error('Registration error: ' . $e->getMessage(), $e->getTrace());
            return redirect()->back()->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }

    public function showTeacherForm()
    {
        return view('auth.register-teacher');
    }

    public function registerTeacher(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'subject' => 'required|string|max:100',
            'institution' => 'required|string|max:100',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => UserRoles::TEACHER->value,
        ]);

        Teacher::create([
            'user_id' => $user->id,
            'subject' => $data['subject'],
            'institution' => $data['institution'],
        ]);

        Wallet::create([
            'user_id' => $user->id,
            'balance' => 0,
        ]);

        // Automatically log in the user after registration
        auth()->login($user);

        return redirect()->route('dashboard.teacher');
    }

    public function showPartnerForm()
    {
        return view('auth.register-partner');
    }

    public function registerPartner(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'cnpj' => 'required|string|max:20',
        ]);

        $user = User::create([
            'name' => $data['company_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => UserRoles::PARTNER->value,
        ]);

        Partner::create([
            'user_id' => $user->id,
            'company_name' => $data['company_name'],
            'cnpj' => $data['cnpj'],
        ]);

        Wallet::create([
            'user_id' => $user->id,
            'balance' => 1000000,
        ]);

        // Automatically log in the user after registration
        auth()->login($user);

        return redirect()->route('dashboard.partner');
    }
}
