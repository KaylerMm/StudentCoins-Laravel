@extends('layouts.app')

@section('content')
    <div class="form-container">
        <h1 class="form-title">Bem-vindo, Aluno!</h1>
        <p class="mb-4">Aqui você pode acompanhar seu progresso, conquistas e recompensas.</p>

        <h1 class="form-title">Bem-vindo, {{ $user->name }}!</h1>
        <p>Saldo da carteira: <strong>{{ $wallet->balance ?? '0' }} 🪙</strong></p>


        <div class="mt-4">
            <a href="#" class="btn-submit">Ver recompensas</a>
        </div>
    </div>
@endsection
