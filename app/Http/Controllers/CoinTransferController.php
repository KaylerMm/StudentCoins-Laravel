<?php

namespace App\Http\Controllers;

use App\Enums\UserRoles;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Partner;
use App\Services\CoinTransferService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CoinTransferController extends Controller
{
    protected $coinTransferService;

    public function __construct(CoinTransferService $coinTransferService)
    {
        $this->coinTransferService = $coinTransferService;
    }

    public function create()
    {
        $user = Auth::user();
        $userType = $this->getUserType($user);
        $wallet = $user->wallet ?? null;

        if ($userType === UserRoles::PARTNER) {
            $recipients = Teacher::with('user')->get();
        }
        else if ($userType === UserRoles::TEACHER) {
            $recipients = Student::with('user')->get();
        }
        else {
            abort(403, 'Acesso negado.');
        }

        return view('coins.transfer', compact('recipients', 'userType', 'wallet'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $userType = $this->getUserType($user);
        $user = $this->getUserByTypeAndId($userType, $user->id);

        $request->validate([
            'recipient_id' => 'required|integer',
            'amount' => 'required|integer|min:1',
        ]);

        // Define o tipo do destinatário esperado
        $recipientType = null;
        if ($userType === UserRoles::PARTNER) {
            $recipientType = UserRoles::TEACHER;
        }
        else if ($userType === UserRoles::TEACHER) {
            $recipientType = UserRoles::STUDENT;
        }
        else {
            abort(403, 'Acesso negado.');
        }

        try {
            $this->coinTransferService->processTransaction(
                $userType,
                $user->id,
                $recipientType,
                $request->recipient_id,
                $request->amount
            );
            return redirect()->back()->with('success', 'Transferência realizada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    protected function getUserType($user)
    {
        if ($user->role == UserRoles::PARTNER->value) {
            return UserRoles::PARTNER;
        }
        if ($user->role == UserRoles::TEACHER->value) {
            return UserRoles::TEACHER;
        }
        if ($user->role == UserRoles::STUDENT->value) {
            return UserRoles::STUDENT;
        }

        return null;
    }

    protected function getUserByTypeAndId(UserRoles $type, int $id)
    {
        switch ($type) {
            case UserRoles::PARTNER:
                return Partner::with('user')->where('user_id', '=', $id)->first();
            case UserRoles::TEACHER:
                return Teacher::with('user')->where('user_id', '=', $id)->first();
            case UserRoles::STUDENT:
                return Student::with('user')->where('user_id', '=', $id)->first();
            default:
                return null;
        }
    }
}
