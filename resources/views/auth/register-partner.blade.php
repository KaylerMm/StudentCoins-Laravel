@extends('layouts.app')

@section('content')
<div class="form-container">
    <h2 class="form-title">Cadastro de Empresa Parceira</h2>

    <form method="POST" action="{{ route('register.partner') }}" class="form">
        @csrf

        <div class="form-group with-icon">
            <label for="company_name">Nome da Empresa</label>
            <div class="input-icon-wrapper">
                <i class="fas fa-building"></i>
                <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}" required />
            </div>
            @error('company_name') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group with-icon">
            <label for="cnpj">CNPJ</label>
            <div class="input-icon-wrapper">
                <i class="fas fa-id-card"></i>
                <input type="text" name="cnpj" id="cnpj" value="{{ old('cnpj') }}" required />
            </div>
            @error('cnpj') <p class="error">{{ $message }}</p> @enderror
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

        <button type="submit" class="btn-submit">Registrar</button>
    </form>
</div>
@endsection
