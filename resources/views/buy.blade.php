<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nieruchomości na sprzedaż - Homeiq</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/buy.css'])
</head>
<body>
@include('includes.navbar')
<section class="search-section py-5 text-white">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3 text-center">Nieruchomości na sprzedaż</h1>
        <p class="lead mb-4 text-center">Znajdź idealną nieruchomość do kupna</p>
        <div class="card shadow p-4">
            <form method="GET">
                <div class="row g-3">
                    <div class="col-md-3">
                        <select class="form-select" name="type">
                            <option value="">Typ nieruchomości</option>
                            <option value="Dom" {{ request('type') == 'Dom' ? 'selected' : '' }}>Dom</option>
                            <option value="Mieszkanie" {{ request('type') == 'Mieszkanie' ? 'selected' : '' }}>Mieszkanie</option>
                            <option value="Lokal użytkowy" {{ request('type') == 'Lokal użytkowy' ? 'selected' : '' }}>Lokal użytkowy</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="region"
                               value="{{ request('region') }}" placeholder="Województwo">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="town"
                               value="{{ request('town') }}" placeholder="Miejscowość">
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="technical_condition">
                            <option value="">Stan techniczny</option>
                            <option value="Do remontu" {{ request('technical_condition') == 'Do remontu' ? 'selected' : '' }}>Do remontu</option>
                            <option value="Do kapitalnego remontu" {{ request('technical_condition') == 'Do kapitalnego remontu' ? 'selected' : '' }}>Do kapitalnego remontu</option>
                            <option value="Budynek w stanie surowym" {{ request('technical_condition') == 'Budynek w stanie surowym' ? 'selected' : '' }}>Budynek w stanie surowym</option>
                            <option value="Gotowy do zamieszkania" {{ request('technical_condition') == 'Gotowy do zamieszkania' ? 'selected' : '' }}>Gotowy do zamieszkania</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="surface_min"
                               value="{{ request('surface_min') }}" placeholder="Powierzchnia od m²">
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="surface_max"
                               value="{{ request('surface_max') }}" placeholder="Powierzchnia do m²">
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="rooms_min"
                               value="{{ request('rooms_min') }}" placeholder="Liczba pokoi od">
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="rooms_max"
                               value="{{ request('rooms_max') }}" placeholder="Pokoje do">
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="furnishings">
                            <option value="">Umeblowanie</option>
                            <option value="Nieumeblowane" {{ request('furnishings') == 'Nieumeblowane' ? 'selected' : '' }}>Nieumeblowane</option>
                            <option value="Częściowo umeblowane" {{ request('furnishings') == 'Częściowo umeblowane' ? 'selected' : '' }}>Częściowo umeblowane</option>
                            <option value="W pełni umeblowane" {{ request('furnishings') == 'W pełni umeblowane' ? 'selected' : '' }}>W pełni umeblowane</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-gradient">Szukaj</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<section class="listings-section py-5 bg-light">
    <div class="container main-container">
        @if($offers->count() > 0)
            <div class="offers-grid">
                @foreach($offers as $offer)
                    <div class="offer-card">
                        <div class="position-relative">
                            <a href="{{ route('properties.show', $offer->id) }}">
                                @if($offer->pictures && $offer->pictures->count() > 0)
                                    <img src="{{ asset('storage/' . $offer->pictures->first()->path) }}"
                                         class="property-image"
                                         alt="{{ $offer->offer_title }}">
                                @else
                                    <div class="no-image">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </a>
                        </div>

                        <div class="card-body">
                            <a href="{{ route('properties.show', $offer->id) }}" class="offer-title">
                                {{ Str::limit($offer->offer_title, 45) }}
                            </a>

                            <div class="offer-badges">
                                <span class="badge badge-type">{{ $offer->property->type }}</span>
                                <span class="badge badge-offer">{{ $offer->offer_type }}</span>
                            </div>

                            <div class="price-section">
                                <div class="price-highlight">
                                    Cena: {{ $offer->price }} zł
                                </div>
                            </div>

                            <div class="location-info">
                                <i class="fas fa-map-marker-alt"></i>
                                {{ $offer->property->town }}, {{ $offer->property->region }}
                            </div>

                            <div class="property-specs">
                                <div class="spec-item">
                                    <i class="fas fa-ruler-combined"></i>
                                    {{ $offer->property->surface }} m²
                                </div>
                                <div class="spec-item">
                                    <i class="fas fa-door-open"></i>
                                    {{ $offer->property->number_of_rooms }} pok.
                                </div>
                                <div class="spec-item">
                                    <i class="fas fa-layer-group"></i>
                                    {{ $offer->property->floor }} piętro
                                </div>
                            </div>

                            <div class="offer-description">
                                {{ Str::limit($offer->description, 100) }}
                            </div>

                            <div class="mb-2">
                                <strong>Stan:</strong> {{ $offer->property->technical_condition }}
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('properties.show', $offer->id) }}" class="btn btn-gradient">
                                <i class="fas fa-eye me-2"></i>Zobacz szczegóły
                            </a>
                            <div class="offer-date">
                                <i class="fas fa-calendar-alt"></i>
                                {{ $offer->created_at->format('d.m.Y') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($offers->hasPages())
                <div class="d-flex justify-content-center">
                    {{ $offers->appends(request()->query())->links() }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3 class="empty-title">Brak ogłoszeń</h3>
                <p class="empty-description">
                    Nie znaleziono nieruchomości na sprzedaż spełniających podane kryteria.
                    Spróbuj zmienić parametry wyszukiwania.
                </p>
            </div>
        @endif
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.offer-card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
    });
</script>
@include('includes.footer')
</body>
</html>
