@extends('layouts.app')

@section('content')
<div class="register-selection-container">
    <h2 class="register-selection-title">Escolha o tipo de cadastro</h2>

    <div class="register-options">
        <form method="GET" action="{{ route('register.student') }}" class="register-option-form">
            <button type="submit" class="register-option-button" aria-label="Sou Aluno">
                <span class="register-option-icon">
                    <i class="fas fa-user-graduate" aria-hidden="true"></i>
                </span>
                <span class="register-option-text">Sou Aluno</span>
            </button>
        </form>

        <form method="GET" action="{{ route('register.teacher') }}" class="register-option-form">
            <button type="submit" class="register-option-button" aria-label="Sou Professor">
                <span class="register-option-icon">
                    <i class="fas fa-chalkboard-teacher" aria-hidden="true"></i>
                </span>
                <span class="register-option-text">Sou Professor</span>
            </button>
        </form>

        <form method="GET" action="{{ route('register.partner') }}" class="register-option-form">
            <button type="submit" class="register-option-button" aria-label="Sou Empresa Parceira">
                <span class="register-option-icon">
                    <i class="fas fa-building" aria-hidden="true"></i>
                </span>
                <span class="register-option-text">Sou Empresa Parceira</span>
            </button>
        </form>
    </div>
</div>
@endsection
