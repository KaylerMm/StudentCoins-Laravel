@extends('layouts.app')

@php
    use App\Enums\UserRoles;
@endphp

@section('content')
<div class="form-container">
    <h1 class="form-title">Transferir Moedas <span class="transfer-icon">🔄</span></h1>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->has('error'))
        <div class="alert-error">{{ $errors->first('error') }}</div>
    @endif

    <form method="POST" action="{{ route('coins.transfer.store') }}">
        @csrf

        @if(isset($wallet->balance))
            <div class="dashboard-balance" style="margin-bottom: 20px;">
                <h2>Seu Saldo Atual</h2>
                <div class="balance-value coin-icon">{{ number_format($wallet->balance ?? 0) }} moedas <span class="coin-icon">🪙</span></div>
            </div>
        @endif

        <div class="form-group">
            <label for="recipient_id">
                @if($userType === UserRoles::PARTNER)
                    Selecionar Professor
                @elseif($userType === UserRoles::TEACHER)
                    Selecionar Aluno
                @endif
            </label>
            <select id="recipient_id" name="recipient_id" required>
                <option value="">-- Selecione --</option>
                @foreach($recipients as $recipient)
                    <option value="{{ $recipient->id }}">
                        {{ $recipient->user->name ?? 'Sem nome' }} 
                        ({{ $recipient->user->email ?? 'sem email' }})
                        - {{ $recipient->user->coins ?? '0' }} moedas
                    </option>
                @endforeach
            </select>
            @error('recipient_id')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="amount">Quantidade de moedas <span class="coin-icon">🪙</span></label>
            <input
                id="amount"
                name="amount"
                type="number"
                min="1"
                required
                value="{{ old('amount') }}"
            />
            <small style="color: #666;">Informe a quantidade de moedas que deseja transferir. Mínimo: 1 moeda.</small>
            @error('amount')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn-submit" id="btn-transfer">Transferir</button>
    </form>
</div>
@endsection
