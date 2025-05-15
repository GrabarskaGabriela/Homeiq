<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homeiq</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('includes.navbar')
</head>
<body>
<!-- Sekcja wyszukiwania -->
<section class="search-section py-5 text-white">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3 text-center">Znajdź swój wymarzony dom</h1>
        <p class="lead mb-4 text-center">Tysiące ofert nieruchomości na wyciągnięcie ręki</p>
        <div class="card shadow p-4">
            <form action="search.php" method="GET">
                <div class="row g-3">
                    <div class="col-md-3">
                        <select class="form-select" name="type">
                            <option value="">Typ nieruchomości</option>
                            <option value="mieszkanie">Mieszkanie</option>
                            <option value="dom">Dom</option>
                            <option value="dzialka">Działka</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="transaction">
                            <option value="">Typ transakcji</option>
                            <option value="sprzedaz">Na sprzedaż</option>
                            <option value="wynajem">Do wynajęcia</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="location" placeholder="Lokalizacja">
                    </div>
                    <div class="col-md-3">
                        <input type="number" class="form-control" name="price_min" placeholder="Cena od">
                    </div>
                    <div class="col-md-3">
                        <input type="number" class="form-control" name="price_max" placeholder="Cena do">
                    </div>
                    <div class="col-md-3">
                        <input type="number" class="form-control" name="area_min" placeholder="Powierzchnia od m²">
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="area_max" placeholder="Powierzchnia do m²">
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary w-100">Szukaj</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Sekcja ogłoszeń -->
<section class="listings-section py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Promowane ogłoszenia</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('images/includes/Ja_gdy_laravel.png') }}" alt="Logo">
                    <div class="card-body">
                        <h5 class="card-title">Nieruchomość Cosikowa</h5>
                        <p class="card-text">Opis nieruchomości lub podstawowe informacje...</p>
                        <a href="offer.blade.php" class="btn btn-primary">Przejdź do oferty</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('images/includes/Ja_gdy_laravel.png') }}" alt="Logo">
                    <div class="card-body">
                        <h5 class="card-title">Nieruchomość Cosikowa</h5>
                        <p class="card-text">Opis nieruchomości lub podstawowe informacje...</p>
                        <a href="offer.blade.php" class="btn btn-primary">Przejdź do oferty</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('images/includes/Ja_gdy_laravel.png') }}" alt="Logo">
                    <div class="card-body">
                        <h5 class="card-title">Nieruchomość Cosikowa</h5>
                        <p class="card-text">Opis nieruchomości lub podstawowe informacje...</p>
                        <a href="offer.blade.php" class="btn btn-primary">Przejdź do oferty</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('images/includes/Ja_gdy_laravel.png') }}" alt="Logo">
                    <div class="card-body">
                        <h5 class="card-title">Nieruchomość Cosikowa</h5>
                        <p class="card-text">Opis nieruchomości lub podstawowe informacje...</p>
                        <a href="offer.blade.php" class="btn btn-primary">Przejdź do oferty</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('includes.footer')
</body>
</html>
<?php $pdo=null; ?>
