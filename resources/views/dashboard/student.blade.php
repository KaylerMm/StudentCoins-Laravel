@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Bem-vindo, {{ $user->name }}! 🎓</h1>
        <p>Aqui você acompanha seu progresso, recompensas e transações.</p>
    </div>

    <div class="dashboard-content">
        <div class="dashboard-balance">
            <h2>Saldo da Carteira</h2>
            <p class="balance-value">
                {{ number_format($wallet->balance ?? 0, 2, ',', '.') }} <span class="coin-icon">🪙</span>
            </p>
        </div>

        <div class="dashboard-actions">
            <a href="{{ route(name: 'rewards') }}" class="btn-submit">Resgatar Uma Vantagem</a>
        </div>
    </div>

    @if($transactions->count())
        <div class="dashboard-transactions">
            <h2>Histórico de Transações</h2>
            <div class="transactions-table-container">
                <table class="transactions-table">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Tipo</th>
                            <th>Valor</th>
                            <th>Para/De</th>
                            <th>Descrição</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $tx)
                            <tr>
                                <td>{{ $tx->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $tx->from_user_id === $user->id ? 'Enviado' : 'Recebido' }}</td>
                                <td>{{ number_format($tx->amount, 2, ',', '.') }} 🪙</td>
                                <td>{{ $tx->from_user_id === $user->id ? $tx->toUser->name : $tx->fromUser->name }}</td>
                                <td>{{ $tx->description ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <p class="no-transactions">Você ainda não realizou nenhuma transação.</p>
    @endif
</div>
@endsection
