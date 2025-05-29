<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje oferty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .main-container {
            padding: 2rem 0;
        }

        .header-section {
            background: linear-gradient(135deg, rgba(18, 67, 105, 0.1), rgba(102, 126, 234, 0.1));
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(18, 67, 105, 0.2);
            animation: slideUp 0.6s ease-out;
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

        .page-title {
            color: #124369;
            font-weight: 700;
            font-size: 2rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .page-subtitle {
            color: #6b7280;
            font-size: 1.1rem;
            margin-top: 0.5rem;
            margin-bottom: 0;
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
            background: linear-gradient(135deg, rgba(18, 67, 105, 0.05), rgba(102, 126, 234, 0.05));
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid rgba(18, 67, 105, 0.1);
        }

        .price-highlight {
            font-size: 1.5rem;
            font-weight: 700;
            color: #124369;
            margin: 0;
        }

        .price-additional {
            font-size: 0.85rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }

        .offer-meta {
            font-size: 0.85rem;
            color: #9ca3af;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .btn-primary {
            background: linear-gradient(to right, #e1c6a9, #ecbfa2) !important;
            border: none;
            border-radius: 12px;
            padding: 0.7rem 1.5rem;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(18, 67, 105, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(18, 67, 105, 0.4);
            background: linear-gradient(to right, #e1c6a9, #ecbfa2) !important;
        }
        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border: none;
            border-radius: 12px;
            padding: 0.6rem 1rem;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
            background: linear-gradient(135deg, #dc2626, #b91c1c);
        }

        .btn-outline-primary {
            border: 2px solid #124369;
            color: #124369;
            border-radius: 12px;
            padding: 0.7rem 1.5rem;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            background: transparent;
        }

        .btn-outline-primary:hover {
            background: #124369;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(18, 67, 105, 0.3);
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

        .alert {
            border-radius: 15px;
            border: none;
            padding: 1.25rem 1.5rem;
            margin-bottom: 2rem;
            animation: slideDown 0.5s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), rgba(21, 128, 61, 0.1));
            color: #15803d;
            border-left: 4px solid #22c55e;
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(220, 38, 38, 0.1));
            color: #dc2626;
            border-left: 4px solid #ef4444;
        }


        .offers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
        }

    </style>
</head>
<body>
@include('includes.navbar')

<div class="container main-container">
    <div class="header-section">
        <h1 class="page-title text-white">
            <div class="section-icon" style="width: 50px; height: 50px; background: #124369; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem;">
                <i class="fas fa-home"></i>
            </div>
            Zarządzaj swoimi ogłoszeniami
        </h1>
    </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($offers->count() > 0)
        <div class="offers-grid">
            @foreach($offers as $offer)
                <div class="offer-card">
                    <div class="position-relative">
                        @if($offer->pictures && $offer->pictures->count() > 0)
                            <img src="{{ asset('storage/' . $offer->pictures->first()->path) }}"
                                 class="property-image"
                                 alt="{{ $offer->offer_title }}">
                        @else
                            <div class="no-image">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                    </div>

                    <div class="card-body">
                        <h5 class="offer-title">{{ Str::limit($offer->offer_title, 45) }}</h5>

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
                            @if(isset($offer->views))
                                <div class="spec-item">
                                    <i class="fas fa-eye"></i>
                                    {{ $offer->views }}
                                </div>
                            @endif
                        </div>

                        <div class="price-section">
                            <div class="price-highlight">
                                {{ number_format($offer->price, 0, ',', ' ') }} zł
                            </div>
                            @if($offer->rent > 0)
                                <div class="price-additional">
                                    + czynsz {{ number_format($offer->rent, 0, ',', ' ') }} zł
                                </div>
                            @endif
                        </div>

                        <div class="offer-meta">
                            <i class="fas fa-calendar-alt"></i>
                            Dodano: {{ $offer->created_at->format('d.m.Y') }}
                        </div>

                        <div class="action-buttons">
                            <a href="{{ route('offers.show', $offer->id) }}" class="btn btn-outline-primary">
                                <i class="fas fa-eye me-2"></i>Zobacz szczegóły
                            </a>

                            <div class="btn-group-responsive">
                                <a href="{{ route('properties.edit', $offer->id) }}" class="btn btn-primary">
                                    <i class="fas fa-edit me-1"></i>Edytuj
                                </a>
                                <form action="{{ route('offers.destroy', $offer->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Czy na pewno chcesz usunąć tę ofertę? Ta akcja jest nieodwracalna.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100">
                                        <i class="fas fa-trash me-1"></i>Usuń
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @if(method_exists($offers, 'links'))
            <div class="d-flex justify-content-center mt-4">
                {{ $offers->links() }}
            </div>
        @endif

    @else
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-home"></i>
            </div>
            <h3 class="empty-title">Nie masz jeszcze żadnych ofert</h3>
            <p class="empty-description">
                Rozpocznij swoją przygodę z nieruchomościami i dodaj pierwszą ofertę sprzedaży lub wynajmu.
                To proste i zajmuje tylko kilka minut!
            </p>
            <a href="{{ route('properties.create') }}" class="btn btn-primary" style="font-size: 1.1rem; padding: 1rem 2rem;">
                <i class="fas fa-plus me-2"></i>Dodaj pierwszą ofertę
            </a>
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Add staggered animation to cards
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.offer-card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
        const actionButtons = document.querySelectorAll('.btn');
        actionButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                if (this.type === 'submit') {
                    setTimeout(() => {
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }, 100);
                }
            });
        });
    });
    function confirmDelete(event) {
        event.preventDefault();
        const form = event.target.closest('form');

        if (confirm('Czy na pewno chcesz usunąć tę ofertę?\n\nTa akcja jest nieodwracalna i spowoduje:\n• Usunięcie wszystkich zdjęć\n• Utratę wszystkich statystyk\n• Niemożność przywrócenia danych')) {
            form.submit();
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('form[onsubmit*="confirm"]');
        deleteForms.forEach(form => {
            form.removeAttribute('onsubmit');
            form.addEventListener('submit', confirmDelete);
        });
    });
</script>

</body>
@include('includes.footer')
</html>
