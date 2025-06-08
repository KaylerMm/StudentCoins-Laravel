@extends('layouts.app')

@php
    use App\Enums\UserRoles;
@endphp

@section('content')
<div class="form-container">
    <h1 class="form-title">Transferir Moedas</h1>

    @if(session('success'))
      <div style="color:green; margin-bottom: 15px;">{{ session('success') }}</div>
    @endif

    @if($errors->has('error'))
      <div style="color:red; margin-bottom: 15px;">{{ $errors->first('error') }}</div>
    @endif

    <form method="POST" action="{{ route('coins.transfer.store') }}">
        @csrf

        <div class="form-group">
            <label for="recipient_id">
                @if($userType === UserRoles::PARTNER)
                    Selecionar Professor
                @elseif($userType === UserRoles::TEACHER)
                    Selecionar Aluno
                @endif
            </label>
            <select id="recipient_id" name="recipient_id" required>
                <option value="">-- Selecione --</option>
                @foreach($recipients as $recipient)
                    <option value="{{ $recipient->id }}" {{ old('recipient_id') == $recipient->id ? 'selected' : '' }}>
                        {{ ($recipient->user->name ?? 'Sem nome' ) . ' - ' . ($recipient->user->email ?? ' Sem email ') }}
                    </option>
                @endforeach
            </select>
            @error('recipient_id')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="amount">Quantidade de moedas</label>
            <input
                id="amount"
                name="amount"
                type="number"
                min="1"
                required
                value="{{ old('amount') }}"
            />
            @error('amount')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn-submit">Transferir</button>
    </form>
</div>
@endsection
