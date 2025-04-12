<nav class="navbar navbar-expand-lg" style="background-color: #845f48;">
    <div class="container">
        <!-- Logo + napis -->
        <a class="navbar-brand fs-3 text-white" href="{{ url('/') }}" style="text-decoration: none;">
            <img src="{{ asset('images/includes/logo.png') }}" alt="Logo" width="50" height="50" class="d-inline-block align-text-top">
            Homeiq
        </a>

        <!-- Przycisk do rozwijania menu -->
        <button class="navbar-toggler shadow-none border-1 border-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu rozwijane -->
        <div class="sidebar offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header text-white border-bottom">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Homeiq - Nieruchomości</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body d-flex flex-column flex-lg-row p-4 p-lg-0">
                <ul class="navbar-nav justify-content-center align-items-center fs-4 flex-grow-1 pe-3">
                    <li class="nav-item mx-2">
                        <a class="btn btn-outline-light me-2" href="{{ route('buy') }}">Kupuję</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="btn btn-outline-light me-2" href="{{ route('rent') }}">Wynajmuję</a>
                    </li>
                    @auth
                        <li class="nav-item mx-2">
                            <a class="btn btn-outline-light me-2" href="{{ route('offers.create') }}">Dodaj ogłoszenie</a>
                        </li>
                    @endauth
                </ul>

                <div class="d-flex flex-lg-row justify-content-center align-items-center gap-3">
                    @auth
                        <!-- Widok dla zalogowanego użytkownika -->
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->first_name ?? 'Moje konto' }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('my.offers') }}"><i class="fas fa-list me-2"></i>Moje ogłoszenia</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user-cog me-2"></i>Profil</a></li>
                                <li><a class="dropdown-item" href="{{ route('help') }}"><i class="fas fa-question-circle me-2"></i>Pomoc</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Wyloguj się</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <img src="{{ Auth::user()->avatar ? asset('storage/'.Auth::user()->avatar) : asset('images/includes/logo.png') }}"
                             alt="Avatar" width="30" height="30" class="rounded-circle">
                    @else
                        <!-- Widok dla niezalogowanego użytkownika -->
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-1"></i> Konto
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-2"></i>Zaloguj się</a></li>
                                <li><a class="dropdown-item" href="{{ route('register') }}"><i class="fas fa-user-plus me-2"></i>Zarejestruj się</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('help') }}"><i class="fas fa-question-circle me-2"></i>Pomoc</a></li>
                            </ul>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>
