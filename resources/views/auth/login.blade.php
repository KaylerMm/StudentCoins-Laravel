@extends('layouts.app')

@section('content')
<div class="form-container">
  <div class="form-card">
    <h1 class="form-title">Entrar</h1>

    <form method="POST" action="{{ route('login') }}" novalidate>
      @csrf

      <div class="form-group">
        <label for="email">Email</label>
        <input
          id="email"
          name="email"
          type="email"
          autocomplete="email"
          required
          autofocus
          value="{{ old('email') }}"
        />
        @error('email')
          <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
        <label for="password">Senha</label>
        <input
          id="password"
          name="password"
          type="password"
          autocomplete="current-password"
          required
        />
        @error('password')
          <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
        <label for="submit">
          <input type="checkbox" name="remember" />
          Lembrar-me
        </label>
        <a href="{{ route('password.request') }}">Esqueceu a senha?</a>
      </div>

      <br>
      
      <div class="form-group">
        <button type="submit" class="btn-submit">Entrar</button>
      </div>
    </form>
  </div>
</div>
@endsection
