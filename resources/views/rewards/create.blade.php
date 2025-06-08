@extends('layouts.app')

@section('content')
<div class="form-container">
    <h1 class="form-title">Criar Nova Vantagem</h1>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('rewards.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group with-icon">
            <label for="name">Nome da Vantagem</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required />
            @error('name') <p class="error-message">{{ $message }}</p> @enderror
        </div>

        <div class="form-group with-icon">
            <label for="description">Descrição</label>
            <textarea name="description" id="description">{{ old('description') }}</textarea>
            @error('description') <p class="error-message">{{ $message }}</p> @enderror
        </div>

        <div class="form-group with-icon">
            <label for="cost">Custo (moedas)</label>
            <input type="number" name="cost" id="cost" value="{{ old('cost') }}" min="1" required />
            @error('cost') <p class="error-message">{{ $message }}</p> @enderror
        </div>

        <div class="form-group with-icon">
            <label for="stock">Estoque</label>
            <input type="number" name="stock" id="stock" value="{{ old('stock') }}" min="0" required />
            @error('stock') <p class="error-message">{{ $message }}</p> @enderror
        </div>

        <div class="form-group with-icon">
            <label for="image">Imagem da Vantagem (opcional)</label>
            <input type="file" name="image" id="image" accept="image/*" />
            @error('image') <p class="error-message">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn-submit">Criar Vantagem</button>
    </form>
</div>
@endsection
