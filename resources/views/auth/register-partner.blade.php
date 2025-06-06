@extends('layouts.app')

@section('content')
<div class="form-container">
    <h2 class="form-title">Cadastro de Empresa Parceira</h2>

    <form method="POST" action="{{ route('register.partner') }}" class="form">
        @csrf

        <div class="form-group">
            <label for="company_name">Nome da Empresa</label>
            <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}" required />
            @error('company_name') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="responsible">Responsável</label>
            <input type="text" name="responsible" id="responsible" value="{{ old('responsible') }}" required />
            @error('responsible') <p class="error">{{ $message }}</p> @enderror
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

        <button type="submit" class="btn-submit">Registrar</button>
    </form>
</div>
@endsection
