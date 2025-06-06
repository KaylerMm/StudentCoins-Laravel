@extends('layouts.app')

@section('content')
    <main class="homepage-container text-center">
        <h1 class="homepage-title">Student Coins</h1>
        <p class="homepage-subtitle mb-12">Escolha o seu perfil para começar a usar a plataforma</p>

        <div class="profiles-wrapper">
            <a href="{{ route('register.student') }}" class="profile-card">
                <i class="fa-solid fa-user-graduate profile-icon"></i>
                <h3 class="profile-title">Aluno</h3>
                <p class="profile-description">Registre-se como estudante e acesse conteúdos personalizados.</p>
            </a>

            <a href="{{ route('register.teacher') }}" class="profile-card">
                <i class="fa-solid fa-chalkboard-user profile-icon"></i>
                <h3 class="profile-title">Professor</h3>
                <p class="profile-description">Cadastre-se como professor e gerencie suas turmas.</p>
            </a>

            <a href="{{ route('register.partner') }}" class="profile-card">
                <i class="fa-solid fa-building profile-icon"></i>
                <h3 class="profile-title">Empresa Parceira</h3>
                <p class="profile-description">Cadastre sua empresa para parcerias e oportunidades.</p>
            </a>
        </div>
    </main>

    <footer class="homepage-footer">
        &copy; {{ date('Y') }} KaylerMm. Todos os direitos reservados.
    </footer>
@endsection
