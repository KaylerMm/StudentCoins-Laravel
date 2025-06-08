@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/rewards.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="rewards-container">
    <h1 class="rewards-title">Minhas Vantagens</h1>

    <form method="GET" class="rewards-filters">
        <input
            type="text"
            name="search"
            placeholder="Buscar por nome..."
            value="{{ request('search') }}"
            class="rewards-input"
        />

        <select name="sort" class="rewards-select">
            <option value="">Ordenar por</option>
            <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>Custo: Menor → Maior</option>
            <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>Custo: Maior → Menor</option>
        </select>

        <button type="submit" class="rewards-button">Filtrar</button>
    </form>

    <div class="rewards-grid">
        @forelse($rewards as $reward)
            <div class="reward-card">
                @if($reward->image_path)
                    <img src="{{ asset('storage/' . $reward->image_path) }}" alt="{{ $reward->name }}" class="reward-image">
                @endif
                <h3 class="reward-name">{{ $reward->name }}</h3>
                <p class="reward-description">{{ $reward->description }}</p>
                <div class="reward-cost">🪙 {{ $reward->cost }} moedas</div>
                <div class="reward-stock">Estoque: {{ $reward->stock }}</div>
            </div>
        @empty
            <p class="no-rewards">Nenhuma vantagem disponível.</p>
        @endforelse
    </div>
</div>
@endsection
