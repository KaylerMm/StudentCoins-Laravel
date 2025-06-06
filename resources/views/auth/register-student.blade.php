@extends('layouts.app')

@section('content')
<h2>Cadastro de Aluno</h2>

<form method="POST" action="{{ route('register.student') }}">
    @csrf

    <label>Nome</label>
    <input type="text" name="name" value="{{ old('name') }}" required>
    @error('name') <div>{{ $message }}</div> @enderror

    <label>Email</label>
    <input type="email" name="email" value="{{ old('email') }}" required>
    @error('email') <div>{{ $message }}</div> @enderror

    <label>Senha</label>
    <input type="password" name="password" required>
    @error('password') <div>{{ $message }}</div> @enderror

    <label>Confirme a senha</label>
    <input type="password" name="password_confirmation" required>

    <label>Turma</label>
    <input type="text" name="turma" value="{{ old('turma') }}" required>
    @error('turma') <div>{{ $message }}</div> @enderror

    <label>Curso</label>
    <input type="text" name="curso" value="{{ old('curso') }}" required>
    @error('curso') <div>{{ $message }}</div> @enderror

    <button type="submit">Registrar</button>
</form>
@endsection
