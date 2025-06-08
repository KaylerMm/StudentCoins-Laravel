@extends('layouts.app')

@section('content')
<div class="modern-login-container">
  <div class="login-card">
    <h1 class="login-title">
      <i class="fas fa-sign-in-alt"></i> Entrar
    </h1>

    <form method="POST" action="{{ route('login') }}" novalidate>
      @csrf

      <div class="form-group with-icon">
        <i class="fas fa-envelope"></i>
        <input
          id="email"
          name="email"
          type="email"
          placeholder="Email"
          value="{{ old('email') }}"
          required
        />
        @error('email')
          <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group with-icon">
        <i class="fas fa-lock"></i>
        <input
          id="password"
          name="password"
          type="password"
          placeholder="Senha"
          required
        />
        @error('password')
          <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-options">
        <label>
          <input type="checkbox" name="remember" />
          Lembrar-me
        </label>
        <a href="{{ route('password.request') }}">Esqueceu a senha?</a>
      </div>

      <button type="submit" class="btn-modern-submit">Entrar</button>
    </form>
  </div>
</div>
@endsection
