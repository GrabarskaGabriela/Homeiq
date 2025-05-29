<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nieruchomości do wynajęcia - Homeiq</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .search-section {
            padding: 3rem 0;
        }

        .main-container {
            padding: 2rem 0;
        }

        .offer-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            animation: slideUp 0.6s ease-out;
            position: relative;
        }

        .offer-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(18, 67, 105, 0.15);
            border-color: rgba(18, 67, 105, 0.3);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .property-image {
            height: 220px;
            width: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .offer-card:hover .property-image {
            transform: scale(1.05);
        }

        .no-image {
            height: 220px;
            background: linear-gradient(135deg, rgba(18, 67, 105, 0.1), rgba(102, 126, 234, 0.1));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #124369;
            font-size: 2rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .offer-title {
            color: #124369;
            font-weight: 600;
            font-size: 1.2rem;
            margin-bottom: 0.75rem;
            line-height: 1.3;
            text-decoration: none;
        }

        .offer-title:hover {
            color: #1e5a8a;
            text-decoration: none;
        }

        .offer-badges {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.4rem 0.8rem;
            border-radius: 10px;
            font-weight: 500;
        }

        .badge-type {
            background: linear-gradient(135deg, #124369, #1e5a8a);
            color: white;
        }

        .badge-offer {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .location-info {
            color: #6b7280;
            font-size: 0.95rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .property-specs {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .spec-item {
            background: rgba(18, 67, 105, 0.1);
            padding: 0.4rem 0.8rem;
            border-radius: 10px;
            font-size: 0.85rem;
            color: #124369;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .price-section {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(217, 119, 6, 0.1));
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .price-highlight {
            font-size: 1.5rem;
            font-weight: 700;
            color: #d97706;
            margin: 0;
        }

        .price-additional {
            font-size: 0.85rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }

        .deposit-info {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            padding: 0.5rem 0.8rem;
            border-radius: 8px;
            font-size: 0.85rem;
            margin-bottom: 1rem;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .offer-description {
            color: #6b7280;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            line-height: 1.4;
        }

        .property-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.5rem;
            margin-bottom: 1rem;
            font-size: 0.85rem;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 0.3rem 0;
            border-bottom: 1px solid rgba(18, 67, 105, 0.1);
        }

        .detail-label {
            font-weight: 500;
            color: #374151;
        }

        .detail-value {
            color: #6b7280;
        }

        .card-footer {
            background: rgba(248, 250, 252, 0.8);
            border-top: 1px solid rgba(18, 67, 105, 0.1);
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-primary {
            background: #124369;
            border: none;
            border-radius: 12px;
            padding: 0.7rem 1.5rem;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(18, 67, 105, 0.3);
            text-decoration: none;
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(18, 67, 105, 0.4);
            background: linear-gradient(135deg, #124369, #1e5a8a);
            color: white;
            text-decoration: none;
        }

        .offer-date {
            font-size: 0.85rem;
            color: #9ca3af;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .offers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
        }

        .empty-state {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 4rem 2rem;
            text-align: center;
            animation: slideUp 0.6s ease-out;
        }

        .empty-icon {
            font-size: 5rem;
            color: #d1d5db;
            margin-bottom: 2rem;
        }

        .empty-title {
            color: #374151;
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .empty-description {
            color: #6b7280;
            font-size: 1.1rem;
            margin-bottom: 2rem;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .pagination {
            margin-top: 3rem;
        }

        .page-link {
            border-radius: 10px;
            border: 1px solid rgba(18, 67, 105, 0.2);
            color: #124369;
            margin: 0 0.2rem;
            transition: all 0.3s ease;
        }

        .page-link:hover {
            background: #124369;
            color: white;
            border-color: #124369;
        }

        .page-item.active .page-link {
            background: #124369;
            border-color: #124369;
        }

        .listings-section {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 70vh;
        }
    </style>
    @include('includes.navbar')
</head>
<body>
<!-- Sekcja wyszukiwania -->
<section class="search-section py-5 text-white">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3 text-center">Nieruchomości do wynajęcia</h1>
        <p class="lead mb-4 text-center">Znajdź idealne miejsce do zamieszkania</p>
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
                        <input type="number" class="form-control" name="rent_min"
                               value="{{ request('rent_min') }}" placeholder="Czynsz od">
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="rent_max"
                               value="{{ request('rent_max') }}" placeholder="Czynsz do">
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
                               value="{{ request('rooms_min') }}" placeholder="Pokoje od">
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
                        <button type="submit" class="btn btn-primary">Szukaj</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Sekcja ogłoszeń -->
<section class="listings-section py-5">
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
                                    {{ $offer->display_price }}
                                </div>
                                <div class="price-additional">miesięcznie</div>
                            </div>

                            @if($offer->deposit > 0)
                                <div class="deposit-info">
                                    <i class="fas fa-shield-alt me-1"></i>
                                    Kaucja: {{ number_format($offer->deposit, 0, ',', ' ') }} zł
                                </div>
                            @endif

                            <div class="location-info">
                                <i class="fas fa-map-marker-alt"></i>
                                {{ $offer->property->full_address }}
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
                                    {{ $offer->property->floor }} p.
                                </div>
                            </div>

                            <div class="property-details">
                                <div class="detail-item">
                                    <span class="detail-label">Umeblowanie:</span>
                                    <span class="detail-value">{{ $offer->property->furnishings }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Stan:</span>
                                    <span class="detail-value">{{ $offer->property->technical_condition }}</span>
                                </div>
                            </div>

                            <div class="offer-description">
                                {{ Str::limit($offer->description, 100) }}
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('properties.show', $offer->id) }}" class="btn btn-primary">
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

            <!-- Paginacja -->
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
                    Nie znaleziono nieruchomości do wynajęcia spełniających podane kryteria.
                    Spróbuj zmienić parametry wyszukiwania.
                </p>
            </div>
        @endif
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Add staggered animation to cards
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
