@extends('layouts.app')

@section('content')
<div class="form-container">
    <h2 class="form-title">Cadastro de Professor</h2>

    <form method="POST" action="{{ route('register.teacher') }}" class="form">
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
            <label for="email">E-mail</label>
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
            <label for="password_confirmation">Confirme a Senha</label>
            <div class="input-icon-wrapper">
                <i class="fas fa-lock"></i>
                <input type="password" name="password_confirmation" id="password_confirmation" required />
            </div>
        </div>

        <div class="form-group with-icon">
            <label for="institution">Instituição</label>
            <div class="input-icon-wrapper">
                <i class="fas fa-university"></i>
                <input type="text" name="institution" id="institution" value="{{ old('institution') }}" required />
            </div>
            @error('class') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group with-icon">
            <label for="subject">Matéria</label>
            <div class="input-icon-wrapper">
                <i class="fas fa-book"></i>
                <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required />
            </div>
            @error('subject') <p class="error">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn-submit">Registrar</button>
    </form>
</div>
@endsection
