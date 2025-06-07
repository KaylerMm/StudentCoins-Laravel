@extends('layouts.app')

@section('content')
<div class="form-container">
    <h2 class="form-title">Cadastro de Professor</h2>

    <form method="POST" action="{{ route('register.teacher') }}" class="form">
        @csrf

        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required />
            @error('name') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required />
            @error('email') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" name="password" id="password" required />
            @error('password') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirme a Senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required />
        </div>

        <div class="form-group">
            <label for="class">Instituição</label>
            <input type="text" name="institution" id="institution" value="{{ old('institution') }}" required />
            @error('class') <p class="error">{{ $message }}</p> @enderror
        </div>
        
        <div class="form-group">
            <label for="subject">Matéria</label>
            <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required />
            @error('subject') <p class="error">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn-submit">Registrar</button>
    </form>
</div>
@endsection
