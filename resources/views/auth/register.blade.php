@extends('layouts.app')

@section('content')
<div class="form-container">
    <h2 class="form-title">Escolha o tipo de cadastro</h2>

    <div class="form">
        <form method="GET" action="{{ route('register.student') }}">
            <button type="submit" class="btn-submit">
                <i class="fas fa-user-graduate" style="margin-right: 8px;"></i>
                Sou Aluno
            </button>
        </form>

        <form method="GET" action="{{ route('register.teacher') }}">
            <button type="submit" class="btn-submit">
                <i class="fas fa-chalkboard-teacher" style="margin-right: 8px;"></i>
                Sou Professor
            </button>
        </form>

        <form method="GET" action="{{ route('register.partner') }}">
            <button type="submit" class="btn-submit">
                <i class="fas fa-building" style="margin-right: 8px;"></i>
                Sou Empresa Parceira
            </button>
        </form>
    </div>
</div>
@endsection
