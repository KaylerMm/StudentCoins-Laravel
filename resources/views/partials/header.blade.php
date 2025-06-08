<header class="site-header">
  <div class="container header-container">
    <a href="{{ url('/') }}" class="logo">
      <i class="fa-solid fa-coins"></i> StudentCoins
    </a>

    <nav class="site-nav" id="navbar">
      <ul>
        <li><a href="{{ route('register.student') }}"><i class="fa-solid fa-user-graduate"></i> Aluno</a></li>
        <li><a href="{{ route('register.teacher') }}"><i class="fa-solid fa-chalkboard-user"></i> Professor</a></li>
        <li><a href="{{ route('register.partner') }}"><i class="fa-solid fa-building"></i> Empresa</a></li>
        <li><a href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket"></i> Login</a></li>
      </ul>
    </nav>

    <button class="nav-toggle" aria-label="Abrir menu">
      <i class="fa-solid fa-bars"></i>
    </button>
  </div>
</header>
