<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $offer->offer_title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/properties_show.css'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
@include('includes.navbar')
<body>
<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-8">
            @if($offer->pictures->count() > 0)
                <div class="card mb-4">
                    <div class="card-body ">
                        <h5 class="card-title mb-3">
                            <i class="fas fa-images feature-icon"></i>Zdjęcia
                        </h5>
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $offer->pictures->first()->path) }}"
                                 class="img-fluid main-image w-100"
                                 id="mainImage"
                                 alt="{{ $offer->offer_title }}">
                        </div>
                        @if($offer->pictures->count() > 1)
                            <div class="d-flex gap-2 flex-wrap">
                                @foreach($offer->pictures as $index => $picture)
                                    <img src="{{ asset('storage/' . $picture->path) }}"
                                         class="thumbnail {{ $index === 0 ? 'active' : '' }}"
                                         onclick="changeMainImage('{{ asset('storage/' . $picture->path) }}', this)"
                                         alt="Zdjęcie {{ $index + 1 }}">
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @endif
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h1 class="card-title h2 mb-2">{{ $offer->offer_title }}</h1>
                            <p class="text-muted mb-0">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                {{ $offer->property->street }} {{ $offer->property->building_number }}
                                @if($offer->property->apartment_number) m. {{ $offer->property->apartment_number }}@endif
                                , {{ $offer->property->postal_code }} {{ $offer->property->town }}, {{ $offer->property->region }}
                            </p>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-primary badge-custom">{{ $offer->property->type }}</span>
                        </div>
                    </div>

                    <div class="price-highlight">
                        Cena: {{ number_format($offer->price, 0, ',', ' ') }} zł
                        @if($offer->rent > 0)
                            <small class="text-muted fs-6">+ {{ number_format($offer->rent, 0, ',', ' ') }} zł czynszu</small>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-align-left feature-icon"></i>Opis
                    </h5>
                    <p class="card-text" style="white-space: pre-line;">{{ $offer->description }}</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-home feature-icon"></i>Szczegóły nieruchomości
                    </h5>

                    <div class="property-details">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-ruler-combined feature-icon"></i>
                                    <div>
                                        <strong>Powierzchnia:</strong><br>
                                        <span>{{ $offer->property->surface }} m²</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-door-open feature-icon"></i>
                                    <div>
                                        <strong>Liczba pokoi:</strong><br>
                                        <span>{{ $offer->property->number_of_rooms }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-building feature-icon"></i>
                                    <div>
                                        <strong>Piętro:</strong><br>
                                        <span>{{ $offer->property->floor }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-tools feature-icon"></i>
                                    <div>
                                        <strong>Stan techniczny:</strong><br>
                                        <span>{{ $offer->property->technical_condition }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-couch feature-icon"></i>
                                    <div>
                                        <strong>Umeblowanie:</strong><br>
                                        <span>{{ $offer->property->furnishings }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar-alt feature-icon"></i>
                                    <div>
                                        <strong>Data dodania:</strong><br>
                                        <span>{{ $offer->created_at->format('d.m.Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-euro-sign feature-icon"></i>Koszty
                    </h5>

                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between px-0">
                            <span><strong>Cena:</strong></span>
                            <span class="text-color_2 fw-bold">{{ number_format($offer->price, 0, ',', ' ') }} zł</span>
                        </div>

                        @if($offer->rent > 0)
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Czynsz:</span>
                                <span>{{ number_format($offer->rent, 0, ',', ' ') }} zł</span>
                            </div>
                        @endif

                        @if($offer->deposit > 0)
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Kaucja:</span>
                                <span>{{ number_format($offer->deposit, 0, ',', ' ') }} zł</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card contact-card mb-4 mx-auto" style="max-width: 400px;">
                <div class="card-body text-center">
                    <i class="fas fa-user-circle fa-3x mb-3"></i>
                    <div class="d-grid gap-2">
                        <h5 class="text-white">{{ $offer->owner->full_name }}</h5>
                        <a href="tel:{{ $offer->owner->phone }}" class="btn btn-outline-light">
                            <i class="fas fa-phone me-2"></i>{{ $offer->owner->phone }}
                        </a>
                        <a href="mailto:{{ $offer->owner->email }}" class="btn btn-outline-light">
                            <i class="fas fa-envelope me-2"></i>Wyślij e-mail
                        </a>
                    </div>

                    <small class="d-block mt-3 opacity-75">
                        <i class="fas fa-shield-alt me-1"></i>Zweryfikowany użytkownik
                    </small>
                </div>
            </div>

            @if(auth()->id() === $offer->owner_id)
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            <i class="fas fa-cog feature-icon"></i>Zarządzaj ofertą
                        </h6>

                        <div class="d-grid gap-2">
                            <a href="{{ route('properties.edit', $offer->property->id) }}" class="btn btn-outline-primary">
                                <i class="fas fa-edit me-2"></i>Edytuj ofertę
                            </a>

                            <a href="#" class="btn btn-outline-danger"
                               onclick="return confirm('Czy na pewno chcesz usunąć tę ofertę?')">
                                <i class="fas fa-trash me-2"></i>Usuń ofertę
                            </a>
                        </div>
                    </div>
                </div>
            @endif

                <!-- Istniejąca karta kontaktowa i opcje dla właściciela -->
                @if(auth()->check() && auth()->id() !== $offer->owner_id)
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-handshake feature-icon"></i>Dokonaj transakcji
                            </h5>
                            <form action="{{ route('transactions.create', $offer->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="transaction_type" class="form-label">Typ transakcji</label>
                                    <select name="transaction_type" id="transaction_type" class="form-select" required>
                                        <option value="purchase">Kupno</option>
                                        @if($offer->rent > 0)
                                            <option value="rental">Wynajem</option>
                                        @endif
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-check me-2"></i>Zainicjuj transakcję
                                </button>
                            </form>
                            @if($errors->any())
                                <div class="alert alert-danger mt-3">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
        </div>
    </div>
</div>
<script>
    function changeMainImage(src, thumbnail) {
        document.getElementById('mainImage').src = src;
        document.querySelectorAll('.thumbnail').forEach(thumb => {
            thumb.classList.remove('active');
        });
        thumbnail.classList.add('active');
    }
</script>
</body>
@include('includes.footer')
</html>
