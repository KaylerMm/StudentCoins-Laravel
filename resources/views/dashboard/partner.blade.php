@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Bem-vindo, Parceiro! 🤝</h1>
        <p>Acompanhe seu saldo, transferências e as vantagens disponíveis.</p>
    </div>

    <div class="dashboard-content">
        <div class="dashboard-balance">
            <h2>Saldo Atual</h2>
            <p class="balance-value">
                {{ number_format($wallet->balance ?? 0, 2, ',', '.') }} <span class="coin-icon">🪙</span>
            </p>
        </div>

        <div class="dashboard-actions">
            <a href="coins/transfer" class="btn-submit">Fazer Nova Transferência</a>
            <a href="#" class="btn-submit">Ver Vantagens</a>
        </div>
    </div>

    @if(isset($transactions) && $transactions->count())
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
        <p class="no-transactions">Nenhuma transação encontrada.</p>
    @endif
</div>
@endsection
