<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj nową nieruchomość</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/properties_create.css'])
</head>
<body>
@include('includes.navbar')
<div class="container main-container">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            <div class="card form-card ">
                <div class="card-header">
                    <h3><i class="fas fa-home me-2"></i>Dodaj nową nieruchomość</h3>
                    <div class="text-white">Wypełnij formularz, aby dodać swoją ofertę</div>
                </div>
                <div class="card-body p-4">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Wystąpiły błędy:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data" id="propertyForm">
                        @csrf
                        <div class="form-section">
                            <h5 class="section-title">
                                <div class="section-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                Lokalizacja nieruchomości
                            </h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="country" class="form-label">
                                        <i class="fas fa-flag me-1"></i> Kraj
                                    </label>
                                    <input type="text" class="form-control" id="country" name="country"
                                           value="{{ old('country', 'Polska') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="region" class="form-label">
                                        <i class="fas fa-map me-1"></i> Województwo
                                    </label>
                                    <input type="text" class="form-control" id="region" name="region"
                                           value="{{ old('region') }}" placeholder="Podaj nazwę województwa" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="town" class="form-label">
                                        <i class="fas fa-city me-1"></i> Miejscowość
                                    </label>
                                    <input type="text" class="form-control" id="town" name="town"
                                           value="{{ old('town') }}" placeholder="Podaj nazwę miejscowości" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="postal_code" class="form-label">
                                        <i class="fas fa-mail-bulk me-1"></i> Kod pocztowy
                                    </label>
                                    <input type="text" class="form-control" id="postal_code" name="postal_code"
                                           value="{{ old('postal_code') }}" placeholder="00-000" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="street" class="form-label">
                                        <i class="fas fa-road me-1"></i> Ulica
                                    </label>
                                    <input type="text" class="form-control" id="street" name="street"
                                           value="{{ old('street') }}" placeholder="Podaj nazwę ulicy" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="building_number" class="form-label">
                                        <i class="fas fa-building me-1"></i> Nr budynku
                                    </label>
                                    <input type="text" class="form-control" id="building_number" name="building_number"
                                           value="{{ old('building_number')}}" placeholder="np. 25A" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="apartment_number" class="form-label">
                                        <i class="fas fa-door-open me-1"></i> Nr mieszkania
                                    </label>
                                    <input type="number" class="form-control" id="apartment_number" name="apartment_number"
                                           value="{{ old('apartment_number')}}" placeholder="np. 2">
                                </div>
                            </div>
                        </div>
                        <div class="form-section">
                            <h5 class="section-title">
                                <div class="section-icon">
                                    <i class="fas fa-cogs"></i>
                                </div>
                                Dane techniczne nieruchomości
                            </h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="type" class="form-label">
                                        <i class="fas fa-home me-1"></i> Typ nieruchomości
                                    </label>
                                    <select class="form-select" id="type" name="type" required>
                                        <option value="">Wybierz typ</option>
                                        <option value="Dom" {{ old('type') == 'Dom' ? 'selected' : '' }}>Dom</option>
                                        <option value="Mieszkanie" {{ old('type') == 'Mieszkanie' ? 'selected' : '' }}>Mieszkanie</option>
                                        <option value="Lokal użytkowy" {{ old('type') == 'Lokal użytkowy' ? 'selected' : '' }}>Lokal użytkowy</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="surface" class="form-label">
                                        <i class="fas fa-ruler-combined me-1"></i> Powierzchnia (m²)
                                    </label>
                                    <input type="number" step="0.01" class="form-control" id="surface" name="surface"
                                           value="{{ old('surface')}}" placeholder="np. 25,24" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="number_of_rooms" class="form-label">
                                        <i class="fas fa-bed me-1"></i> Liczba pokoi
                                    </label>
                                    <input type="number" class="form-control" id="number_of_rooms" name="number_of_rooms"
                                           value="{{ old('number_of_rooms') }}" min="1" placeholder="min. 1" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="floor" class="form-label">
                                        <i class="fas fa-layer-group me-1"></i> Piętro
                                    </label>
                                    <input type="number" class="form-control" id="floor" name="floor"
                                           value="{{ old('floor') }}" placeholder="Numer piętra lub 0 dla partrerowych nieruchomości" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="technical_condition" class="form-label">
                                        <i class="fas fa-tools me-1"></i> Stan techniczny
                                    </label>
                                    <select class="form-select" id="technical_condition" name="technical_condition" required>
                                        <option value="">Wybierz stan techniczny nieruchomości</option>
                                        <option value="Do remontu" {{ old('technical_condition') == 'Do remontu' ? 'selected' : '' }}>Do remontu</option>
                                        <option value="Do kapitalnego remontu" {{ old('technical_condition') == 'Do kapitalnego remontu' ? 'selected' : '' }}>Do kapitalnego remontu</option>
                                        <option value="Budynek w stanie surowym" {{ old('technical_condition') == 'Budynek w stanie surowym' ? 'selected' : '' }}>Budynek w stanie surowym</option>
                                        <option value="Gotowy do zamieszkania" {{ old('technical_condition') == 'Gotowy do zamieszkania' ? 'selected' : '' }}>Gotowy do zamieszkania</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="furnishings" class="form-label">
                                        <i class="fas fa-couch me-1"></i> Umeblowanie
                                    </label>
                                    <select class="form-select" id="furnishings" name="furnishings" required>
                                        <option value="">Wybierz stopień umeblowania nieruchomości</option>
                                        <option value="Nieumeblowane" {{ old('furnishings') == 'Nieumeblowane' ? 'selected' : '' }}>Nieumeblowane</option>
                                        <option value="Częściowo umeblowane" {{ old('furnishings') == 'Częściowo umeblowane' ? 'selected' : '' }}>Częściowo umeblowane</option>
                                        <option value="W pełni umeblowane" {{ old('furnishings') == 'W pełni umeblowane' ? 'selected' : '' }}>W pełni umeblowane</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h5 class="section-title">
                                <div class="section-icon">
                                    <i class="fas fa-tag"></i>
                                </div>
                                Szczegóły oferty
                            </h5>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="offer_title" class="form-label">
                                        <i class="fas fa-heading me-1"></i> Tytuł oferty
                                    </label>
                                    <input type="text" class="form-control" id="offer_title" name="offer_title"
                                           value="{{ old('offer_title') ?? "Przykładowy tytuł oferty"}}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="offer_type" class="form-label">
                                        <i class="fas fa-handshake me-1"></i> Typ ogłoszenia
                                    </label>
                                    <select class="form-select" id="offer_type" name="offer_type" required>
                                        <option value="">Wybierz typ</option>
                                        <option value="Sprzedaż" {{ old('offer_type') == 'Sprzedaż' ? 'selected' : '' }}>Sprzedaż</option>
                                        <option value="Wynajem" {{ old('offer_type') == 'Wynajem' ? 'selected' : '' }}>Wynajem</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="description" class="form-label">
                                        <i class="fas fa-align-left me-1"></i> Opis
                                    </label>
                                    <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description') ?? "Przykładowy opis nieruchomości"}}</textarea>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="price" class="form-label">
                                        <i class="fas fa-money-bill-wave me-1"></i> Cena (zł)
                                    </label>
                                    <input type="number" class="form-control" id="price" name="price"
                                           value="{{ old('price') ?? 0 }}" min="0" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="deposit" class="form-label">
                                        <i class="fas fa-shield-alt me-1"></i> Kaucja (zł)
                                    </label>
                                    <input type="number" class="form-control" id="deposit" name="deposit"
                                           value="{{ old('deposit')  ?? 0}}" min="0" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="rent" class="form-label">
                                        <i class="fas fa-receipt me-1"></i> Czynsz (zł)
                                    </label>
                                    <input type="number" class="form-control" id="rent" name="rent"
                                           value="{{ old('rent') ?? 0 }}" min="0" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h5 class="section-title">
                                <div class="section-icon">
                                    <i class="fas fa-camera"></i>
                                </div>
                                Zdjęcia nieruchomości
                            </h5>
                            <div class="mb-3">
                                <label for="pictures" class="form-label">Dodaj przynajmniej jedno zdjęcie nieruchomości</label>
                                <input type="file" class="form-control" id="pictures" name="pictures[]"
                                       multiple accept="image/*">
                                <div class="form-text">Maksymalny rozmiar: 2MB na zdjęcie.</div>
                            </div>
                            <div id="imagePreview" class="preview-images"></div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('index') }}" class="btn btn-secondary me-md-2">Anuluj</a>
                            <button type="submit" class="btn btn-primary">Dodaj nieruchomość</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('pictures').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        preview.innerHTML = '';

        Array.from(e.target.files).forEach((file, index) => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'preview-image';
                    div.innerHTML = `
                        <img src="${e.target.result}" alt="Podgląd">
                        <button type="button" class="remove-image" onclick="removeImage(${index})" title="Usuń zdjęcie">
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="image-label">Nowe</div>
                    `;
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            }
        });
    });
    function removeImage(index) {
        const input = document.getElementById('pictures');
        const dt = new DataTransfer();
        Array.from(input.files).forEach((file, i) => {
            if (i !== index) {
                dt.items.add(file);
            }
        });
        input.files = dt.files;
        input.dispatchEvent(new Event('change'));
    }
</script>
</body>
@include('includes.footer')
</html>
