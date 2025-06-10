@extends('layouts.app')

@php
use App\Enums\UserRoles;
@endphp

@section('content')

<div class="reward-detail-container">
    <h1 class="reward-detail-title">{{ $reward->name }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <ul><li>{{ session('error') }}</li></ul>
        </div>
    @endif

    <div class="reward-detail-card">
        @if($reward->image_path)
            <img src="{{ asset('storage/' . $reward->image_path) }}" alt="{{ $reward->name }}" class="reward-detail-image">
        @endif

        <p class="reward-detail-description">{{ $reward->description }}</p>
        <div class="reward-detail-cost">🪙 {{ $reward->cost }} moedas</div>
        <div class="reward-detail-stock">Estoque: {{ $reward->stock }}</div>

        @if(Auth::user()->role === UserRoles::STUDENT->value)
            <form action="{{ route('rewards.redeem', $reward) }}" method="POST" class="reward-detail-redeem-form" onsubmit="return confirmRedeem('{{ $reward->name }}', {{ $reward->cost }});">
                @csrf
                <button type="submit" class="btn-redeem">Resgatar</button>
            </form>
        @endif
    </div>
</div>

<script>
    function confirmRedeem(rewardName, rewardCost) {
        return confirm(`Tem certeza que deseja resgatar a vantagem "${rewardName}" por ${rewardCost} moedas?`);
    }
</script>

@endsection
