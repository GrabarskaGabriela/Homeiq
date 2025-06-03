<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje oferty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/my_offers.css'])
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
                        <div class="offer-meta">
                            <i class="fas fa-calendar-alt"></i>
                            Dodano: {{ $offer->created_at->format('d.m.Y') }}
                        </div>

                        <div class="action-buttons">
                            <a href="{{ route('properties.show', $offer->id) }}" class="btn btn-outline-primary">
                                <i class="fas fa-eye me-2"></i>Zobacz szczegóły
                            </a>
                                <a href="{{ route('properties.edit', $offer->id) }}" class="btn btn-primary w-100">
                                    <i class="fas fa-edit me-2 "></i>Edytuj
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
