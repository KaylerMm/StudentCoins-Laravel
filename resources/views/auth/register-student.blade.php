@extends('layouts.app')

@section('content')
<div class="form-container">
    <h2 class="form-title">Cadastro de Aluno</h2>

    <form method="POST" action="{{ route('register.student') }}" class="form">
        @csrf

        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required />
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required />
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" name="password" id="password" required />
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirme a senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required />
        </div>

        <div class="form-group">
            <label for="class">Turma</label>
            <input type="text" name="class" id="class" value="{{ old('class') }}" required />
            @error('class')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="course">Curso</label>
            <input type="text" name="course" id="course" value="{{ old('course') }}" required />
            @error('course')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn-submit">
            Registrar
        </button>
    </form>
</div>
@endsection
