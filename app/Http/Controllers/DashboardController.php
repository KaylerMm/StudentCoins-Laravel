<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRoles;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $wallet = $user->wallet ?? null;

        switch ($user->role) {
            case UserRoles::STUDENT->value:
                return view('dashboard.student', compact('user', 'wallet'));

            case UserRoles::TEACHER->value:
                return view('dashboard.teacher', compact('user', 'wallet'));

            case UserRoles::PARTNER->value:
                return view('dashboard.partner', compact('user', 'wallet'));

            default:
                \Log::warning('Unauthorized access attempt to dashboard', [
                    'user_id' => $user->id,
                    'role' => $user->role,
                    'ip' => request()->ip(),
                ]);
                abort(403, 'User role not authorized to access the dashboard.');
        }
    }
}
