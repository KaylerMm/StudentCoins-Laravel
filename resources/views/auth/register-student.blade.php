@extends('layouts.app')

@section('content')
<div class="form-container">
    <h2 class="form-title">Cadastro de Aluno</h2>

    <form method="POST" action="{{ route('register.student') }}" class="form">
        @csrf

        <div class="form-group with-icon">
            <label for="name">Nome</label>
            <div class="input-icon-wrapper">
                <i class="fas fa-user"></i>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required />
            </div>
            @error('name') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group with-icon">
            <label for="email">Email</label>
            <div class="input-icon-wrapper">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required />
            </div>
            @error('email') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group with-icon">
            <label for="password">Senha</label>
            <div class="input-icon-wrapper">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" required />
            </div>
            @error('password') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group with-icon">
            <label for="password_confirmation">Confirme a senha</label>
            <div class="input-icon-wrapper">
                <i class="fas fa-lock"></i>
                <input type="password" name="password_confirmation" id="password_confirmation" required />
            </div>
        </div>

        <div class="form-group with-icon">
            <label for="class">Turma</label>
            <div class="input-icon-wrapper">
                <i class="fas fa-users"></i>
                <input type="text" name="class" id="class" value="{{ old('class') }}" required />
            </div>
            @error('class') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group with-icon">
            <label for="course">Curso</label>
            <div class="input-icon-wrapper">
                <i class="fas fa-graduation-cap"></i>
                <input type="text" name="course" id="course" value="{{ old('course') }}" required />
            </div>
            @error('course') <p class="error">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn-submit">
            Registrar
        </button>
    </form>
</div>
@endsection
