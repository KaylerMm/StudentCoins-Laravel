@extends('layouts.app')

@section('content')
<main class="homepage-container text-center">
    <h1 class="homepage-title mb-4">Bem-vindo ao <span class="text-primary font-bold">Student Coins</span></h1>
    <p class="homepage-subtitle mb-12 text-lg text-gray-600">
        Uma plataforma gamificada onde você pode ganhar moedas, fazer transferências e resgatar recompensas.
    </p>

    <h2 class="text-xl font-semibold mb-6">Como deseja continuar?</h2>

    <div class="profiles-wrapper grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <a href="{{ route('login') }}" class="profile-card login-card">
            <i class="fa-solid fa-right-to-bracket profile-icon"></i>
            <h3 class="profile-title">Já tenho conta</h3>
            <p class="profile-description">Entre para acompanhar seu saldo e recompensas.</p>
        </a>

        <a href="{{ route('register.student') }}" class="profile-card">
            <i class="fa-solid fa-user-graduate profile-icon"></i>
            <h3 class="profile-title">Sou Aluno</h3>
            <p class="profile-description">Acesse conteúdos personalizados e ganhe moedas estudantis.</p>
        </a>

        <a href="{{ route('register.teacher') }}" class="profile-card">
            <i class="fa-solid fa-chalkboard-user profile-icon"></i>
            <h3 class="profile-title">Sou Professor</h3>
            <p class="profile-description">Gerencie turmas e incentive alunos com recompensas.</p>
        </a>

        <a href="{{ route('register.partner') }}" class="profile-card">
            <i class="fa-solid fa-building profile-icon"></i>
            <h3 class="profile-title">Sou Empresa</h3>
            <p class="profile-description">Ofereça benefícios reais em troca das moedas estudantis.</p>
        </a>
    </div>
</main>

<footer class="homepage-footer mt-12 text-sm text-gray-500">
    &copy; {{ date('Y') }} KaylerMm. Todos os direitos reservados.
</footer>
@endsection
