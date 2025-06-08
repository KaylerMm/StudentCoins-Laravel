<header class="site-header">
  <div class="container header-container">
    <a href="{{ url('/') }}" class="logo">
      🪙 StudentCoins
    </a>

    <nav class="site-nav" id="navbar">
      <ul>
        @guest
          <li><a href="{{ route('home') }}">🏠 Home</a></li>
          <li><a href="{{ url('/login') }}">👤 Entrar</a></li>
        @endguest
        
        @auth
          <li><a href="{{ route('dashboard') }}">💰 Dashboard</a></li>
          <li>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="btn-logout">
                <i class="fa-solid fa-right-from-bracket"></i> Sair
              </button>
            </form>
          </li>
        @endauth
      </ul>
    </nav>

    <button class="nav-toggle" aria-label="Abrir menu">
      <i class="fa-solid fa-bars"></i>
    </button>
  </div>
</header>
