<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand fs-3 text-color" href="{{ url('/') }}" style="text-decoration: none;">
            <img src="{{ asset('images/includes/logo.png') }}" alt="Logo" width="50" height="50" class="d-inline-block align-text-top">
            Homeiq
        </a>

        <button class="navbar-toggler shadow-none border-1 border-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="sidebar offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header text-color border-bottom">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Homeiq - Nieruchomości</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body d-flex flex-column flex-lg-row p-4 p-lg-0">
                <ul class="navbar-nav justify-content-center align-items-center fs-4 flex-grow-1 pe-3 text-color">
                    <li class="nav-item mx-2">
                        <a class="btn btn-gradient-nav text-color me-2" href="{{ route('properties.buy') }}">Kupuję</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="btn btn-gradient-nav text-color me-2" href="{{ route('properties.rent') }}">Wynajmuję</a>
                    </li>
                    @auth
                        <li class="nav-item mx-2">
                            <a class="btn btn-gradient-nav text-color me-2" href="{{ route('properties.create') }}">Dodaj ogłoszenie</a>
                        </li>
                    @endauth
                </ul>

                <div class="d-flex flex-lg-row justify-content-center align-items-center gap-3">
                    @auth
                        <div class="dropdown">
                            <a class="btn btn-gradient-nav text-color dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->first_name ?? 'Moje konto' }}
                            </a>
                            <ul class="dropdown-menu shadow-color">
                                <li><a class="dropdown-item text-color"  href="{{ route('offers.my-offers') }}"><i class="fas fa-list me-2"></i>Moje ogłoszenia</a></li>
                                <li><a class="dropdown-item text-color" href="{{ route('profile.edit') }}"><i class="fas fa-user-cog me-2"></i>Ustawienia</a></li>
                                <li><a class="dropdown-item text-color" href="{{ route('help') }}"><i class="fas fa-question-circle me-2"></i>Pomoc</a></li>
                                <li><a class="dropdown-item text-color" href="{{ route('contact') }}"><i class="fas fa-question-circle me-2"></i>Kontakt</a></li>
                                @if(Auth::user()->role === 'admin')
                                    <li class="nav-item">
                                        <a class="dropdown-item text-color" href="{{ route('admin.dashboard') }}"><i class="fa fa-file-text me-2" aria-hidden="true"></i>Raporty</a>
                                    </li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2 text-color"></i>Wyloguj się</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-gradient-nav text-color me-2">
                            Zaloguj się
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>
