<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Reward;
use App\Models\Transaction;
use App\Enums\UserRoles;
use Illuminate\Support\Facades\Auth;

class RewardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Reward::where('stock', '>', 0);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->sort === 'asc') {
            $query->orderBy('cost', 'asc');
        } elseif ($request->sort === 'desc') {
            $query->orderBy('cost', 'desc');
        }

        $rewards = $query->get();

        return view('rewards.index', compact('rewards'));
    }

    public function create()
    {
        $user = Auth::user();

        if ($user->role != UserRoles::PARTNER->value) {
            abort(403, 'User role not authorized to access rewards creation screen.');
        }

        return view('rewards.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cost' => 'required|integer|min:1',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image',
        ]);

        $partner = Auth::user();

        $data = $request->only(['name', 'description', 'cost', 'stock']);
        $data['partner_id'] = $partner->id;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('rewards', 'public');
            $data['image_path'] = $path;
        }

        Reward::create($data);

        return redirect()->route('rewards')->with('success', 'Vantagem criada com sucesso!');
    }

    public function redeem(Request $request, Reward $reward)
    {
        try{
            $user = Auth::user();
    
            if ($user->wallet->balance < $reward->cost) {
                return redirect()->back()->with('error', 'Você não tem moedas suficientes para resgatar esta vantagem.');
            }
            
            if ($reward->stock <= 0) {
                return redirect()->back()->with('error', 'Esta vantagem está esgotada.');
            }
            
            DB::transaction(function () use ($user, $reward) {
                // Deduct coins from user
                $user->wallet->balance -= $reward->cost;
                $user->wallet->save();
                
                // Update reward stock
                $reward->stock -= 1;
                $reward->save();
                
                // Create transaction record
                Transaction::create([
                    'from_user_id' => $user->id,
                    'to_user_id' => $reward->partner_id,
                    'amount' => $reward->cost,
                    'type' => 'reward',
                    'description' => "Resgatou a vantagem: {$reward->name}",
                ]);
            });
            
            return redirect()->route('rewards')->with('success', 'Vantagem resgatada com sucesso!');
        }
        catch (\Exception $e) {
            \Log::error('Error redeeming reward: ' . $e->getMessage(), [
                'user_id' => $user->id,
                'reward_id' => $reward->id,
                $e->getTrace()
            ]);
            return redirect()->route('rewards')->with('error', 'Erro ao resgatar a vantagem. Por favor, tente novamente.');
        }
    }

    public function show(Reward $reward)
    {
        return view('rewards.show', compact('reward'));
    }
}
