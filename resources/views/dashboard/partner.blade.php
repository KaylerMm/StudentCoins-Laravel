@extends('layouts.app')

@section('content')
    <div class="form-container">
        <h1 class="form-title">Bem-vindo, Parceiro!</h1>
        <p class="mb-4">Aqui você pode acompanhar seu saldo, transferências e vantangens cadastradas.</p>

        <h1 class="form-title">Bem-vindo, {{ $user->name }}!</h1>
        <p>Saldo da carteira: <strong>{{ $wallet->balance ?? '0' }} 🪙</strong></p>


        <div class="mt-4">
            <a href="#" class="btn-submit">Ver transferências</a>
        </div>
        <div class="mt-4">
            <a href="#" class="btn-submit">Ver vantangens</a>
        </div>
    </div>
@endsection
