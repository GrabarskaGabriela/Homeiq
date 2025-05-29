<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $offer->offer_title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>


        .card {
            background: #ffffff;
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .card-body {
            padding: 2rem;
        }

        .card-title {
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .card-title i {
            color: #6f4e37;
            font-size: 1.2rem;
        }

        .property-image {
            height: 250px;
            object-fit: cover;
            border-radius: 12px;
        }

        .main-image {
            height: 450px;
            object-fit: cover;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .main-image:hover {
            transform: scale(1.02);
        }

        .thumbnail {
            height: 80px;
            width: 80px;
            object-fit: cover;
            cursor: pointer;
            border: 3px solid transparent;
            border-radius: 12px;
            transition: all 0.3s ease;
            opacity: 0.7;
        }

        .thumbnail:hover {
            border-color: #6f4e37;
            opacity: 1;
            transform: scale(1.05);
        }

        .thumbnail.active {
            color: #806b61;;
            opacity: 1;
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
        }

        .feature-icon {
            color: #6f4e37;
            margin-right: 12px;
            font-size: 1.1rem;
        }

        .price-highlight {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #c0a891, #b6977d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 1rem 0;
        }

        .property-details {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border-radius: 16px;
            padding: 2rem;
            border: 1px solid #e2e8f0;
        }

        .property-detail-item {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
            border: 1px solid #f1f5f9;
        }

        .property-detail-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border-color: #e2e8f0;
        }

        .property-detail-item i {
            font-size: 1.5rem;
            background: linear-gradient(to right, 	#c0a891, #b6977d) !important;
            margin-right: 1rem;
        }

        .property-detail-item strong {
            color: #1e293b;
            font-weight: 600;
            display: block;
            margin-bottom: 0.25rem;
        }

        .property-detail-item span {
            color: #64748b;
            font-size: 1.1rem;
        }

        .badge-custom {
            font-size: 0.9rem;
            padding: 10px 16px;
            border-radius: 25px;
            font-weight: 600;
            background: linear-gradient(to right, 	#c0a891, #b6977d) !important;
            border: none;
        }

        .contact-card {
            background: linear-gradient(to right, 	#c0a891, #b6977d) !important;
            color: white;
            position: sticky;
            top: 100px;
        }

        .contact-card .card-body {
            text-align: center;
        }

        .contact-card i {
            color: rgba(255, 255, 255, 0.9);
        }

        .btn-contact {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            border-radius: 12px;
            padding: 12px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .btn-contact:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.4);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .cost-card .list-group-item {
            background: transparent;
            border: none;
            border-bottom: 1px solid #f1f5f9;
            padding: 1rem 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cost-card .list-group-item:last-child {
            border-bottom: none;
        }

        .cost-value {
            font-weight: 700;
            font-size: 1.1rem;
        }

        .cost-value.price {
            color:  #b6977d;
            font-size: 1.3rem;
        }

        .management-card {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border: 1px solid #e2e8f0;
        }

        .btn-management {
            border-radius: 12px;
            padding: 12px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-management:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .location-text {
            color: #64748b;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }


        .alert {
            border: none;
            border-radius: 12px;
            padding: 1rem 1.5rem;
        }

        .alert-success {
            background: linear-gradient(135deg, #ecfdf5, #d1fae5);
            color: #b6977d;
            border-left: 4px solid #10b981;
        }

        .image-gallery {
            position: relative;
        }

        .image-counter {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            backdrop-filter: blur(10px);
        }


        @media (max-width: 768px) {
            .card-body {
                padding: 1.5rem;
            }

            .main-image {
                height: 300px;
            }

            .price-highlight {
                font-size: 2rem;
            }

            .property-details {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
@include('includes.navbar')
<div class="container mt-4">


    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <!-- Główna zawartość -->
        <div class="col-lg-8">
            <!-- Zdjęcia -->
            @if($offer->pictures->count() > 0)
                <div class="card mb-4">
                    <div class="card-body ">
                        <h5 class="card-title mb-3">
                            <i class="fas fa-images feature-icon"></i>Zdjęcia
                        </h5>

                        <!-- Główne zdjęcie -->
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $offer->pictures->first()->path) }}"
                                 class="img-fluid main-image w-100"
                                 id="mainImage"
                                 alt="{{ $offer->offer_title }}">
                        </div>

                        <!-- Miniatury -->
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
            <!-- Tytuł i podstawowe info -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h1 class="card-title h2 mb-2">{{ $offer->offer_title }}</h1>
                            <p class="text-muted mb-0">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                {{ $offer->property->street }} {{ $offer->property->building_number }}
                                @if($offer->property->apartment_number), m. {{ $offer->property->apartment_number }}@endif
                                {{ $offer->property->postal_code }} {{ $offer->property->town }}, {{ $offer->property->region }}
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

            <!-- Opis -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-align-left feature-icon"></i>Opis
                    </h5>
                    <p class="card-text" style="white-space: pre-line;">{{ $offer->description }}</p>
                </div>
            </div>

            <!-- Szczegóły nieruchomości -->
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

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Informacje cenowe -->
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

            <!-- Informacje o właścicielu -->
            <div class="card contact-card mb-4 mx-auto" style="max-width: 400px;">
                <div class="card-body text-center">
                    <i class="fas fa-user-circle fa-3x mb-3"></i>
                    <h5 class="card-title text-white">{{ $offer->owner->full_name }}</h5>

                    <div class="d-grid gap-2">
                        <a href="tel:{{ $offer->owner->phone }}" class="btn btn-light">
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


            <!-- Akcje (jeśli to właściciel) -->
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
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function changeMainImage(src, thumbnail) {
        document.getElementById('mainImage').src = src;

        // Usuń active z wszystkich miniatur
        document.querySelectorAll('.thumbnail').forEach(thumb => {
            thumb.classList.remove('active');
        });

        // Dodaj active do klikniętej miniatury
        thumbnail.classList.add('active');
    }
</script>
</body>
@include('includes.footer')
</html>
