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
    @forelse ($offerts as $offer)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm text-color">
                <a href="{{ route('events.show', $offer->id) }}">
                    @if(isset($offer->photos) && count($offer->photos) > 0)
                        <img src="{{ asset('storage/' . $offer->photos[0]->path) }}"
                             alt="{{ $offer->title }}"
                             class="card-img-top"
                             style="height: 250px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/includes/brak_zdjecia.jpg') }}"
                             alt="Brak zdjęcia"
                             class="card-img-top w-100"
                             style="height: 250px; object-fit: cover;">
                    @endif
                </a>
                <div class="card-body">
                    <h5 class="card-title">{{ $offer->title }}</h5>
                    <p><strong>{{ __('messages.myevents.date') }}</strong> {{ \Carbon\Carbon::parse($offer->date)->format('d.m.Y H:i') }}</p>
                    <p><strong>{{ __('messages.myevents.location') }}</strong> {{ $offer->location_name }}</p>
                    <p class="text-truncate">{{ Str::limit($offer->description, 100) }}</p>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('events.show', $offer->id) }}"  class="btn btn-gradient text-color">{{ __('messages.myevents.check') }}</a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">
                {{ __('messages.myevents.noEvent') }}
            </div>
        </div>
    @endforelse
</section>
@include('includes.footer')
</body>
</html>
<?php $pdo=null; ?>
