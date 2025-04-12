<nav class="navbar navbar-expand-lg" style="background-color: #845f48;">
    <div class="container">
        <!-- Logo + napis -->
        <a class="navbar-brand fs-3 text-white" href="{{ url('/') }}" style="text-decoration: none;">
            <img src="{{ asset('images/includes/logo.png') }}" alt="Logo" width="50" height="50" class="d-inline-block align-text-top">
            Homeiq
        </a>

        <!-- Guziczek do rozwijania menu na mniejszym oknie -->
        <button class="navbar-toggler shadow-none border-1 border-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Sidebar, menu rozwijane w mniejszym oknie -->
        <div class="sidebar offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header text-white border-bottom">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Homeiq - Nieruchomości</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body d-flex flex-column flex-lg-row p-4 p-lg-0">
                <ul class="navbar-nav justify-content-center align-items-center fs-4 flex-grow-1 pe-3">
                    <li class="nav-item mx-2">
                        <button class="btn me-2 text-white" type="button" onclick="window.location.href='kupuje.blade.php'">Kupuję</button>
                    </li>
                    <li class="nav-item mx-2">
                        <button class="btn me-2 text-white" type="button" onclick="window.location.href='wynajmuje.blade.php'">Wynajmuję</button>
                    </li>
                    <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                    <li class="nav-item mx-2">
                        <button class="btn me-2 text-white" type="button" onclick="window.location.href='wystawianie_oferty.blade.php'">Dodaj ogłoszenie</button>
                    </li>
                    <?php endif; ?>
                </ul>

                <div class="d-flex flex-lg-row justify-content-center align-items-center gap-3">
                    <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                        <!-- Widok dla zalogowanego użytkownika -->
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Moje konto
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('my_offers') }}">Moje ogłoszenia</a></li>
                            <li><a class="dropdown-item" href="{{ route('help') }}">Pomoc</a></li>
                            <li><a class="dropdown-item" href="{{ route('settings') }}">Ustawienia</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Wyloguj się</a></li>
                        </ul>
                    </div>
                    <img src="includes/avatar.png" alt="Avatar" width="30" height="30" class="d-inline-block align-text-top">
                    <?php else: ?>
                        <!-- Widok dla niezalogowanego użytkownika -->
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Zaloguj się
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('login') }}">Zaloguj się</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="pomoc.php">Pomoc</a></li>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</nav>
