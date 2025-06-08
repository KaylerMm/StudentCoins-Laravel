<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;
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
}
