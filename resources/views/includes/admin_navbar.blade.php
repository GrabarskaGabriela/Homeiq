<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('index') }}">
            <i class="fas fa-home"></i> HOMEIQ
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.properties') }}">
                        <i class="fas fa-building"></i> Nieruchomości
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.users') }}">
                        <i class="fas fa-users"></i> Użytkownicy
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.offers') }}">
                        <i class="fas fa-tags"></i> Oferty
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.transactions') }}">
                        <i class="fas fa-handshake"></i> Transakcje
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
