<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj nieruchomość</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .main-container {
            padding: 2rem 0;
        }

        .form-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
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

        .card-header {
            background: #124369;
            color: white;
            padding: 2rem;
            text-align: center;
            border: none;
        }

        .card-header h3 {
            font-size: 1.8rem;
            font-weight: 600;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .card-header .subtitle {
            opacity: 0.9;
            font-size: 1rem;
            margin-top: 0.5rem;
        }

        .form-section {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(240, 147, 251, 0.05));
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(102, 126, 234, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .form-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: #124369;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .form-section:hover::before {
            opacity: 1;
        }

        .form-section:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
        }

        .section-title {
            color: #124369;
            font-weight: 600;
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-icon {
            width: 40px;
            height: 40px;
            background: #124369;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-control, .form-select {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 0.8rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-control:focus, .form-select:focus {
            border-color: #124369;
            transform: translateY(-1px);
            background: white;
        }

        .form-control:hover, .form-select:hover {
            border-color: #124369;
            background: white;
        }

        .preview-images {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .preview-image {
            position: relative;
            width: 100%;
            height: 180px;
            border-radius: 15px;
            overflow: hidden;
            border: 3px solid #e5e7eb;
            transition: all 0.3s ease;
            background: white;
        }

        .preview-image:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            border-color: #124369;
        }

        .preview-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .preview-image:hover img {
            transform: scale(1.05);
        }

        .remove-image {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(239, 68, 68, 0.9);
            color: white;
            border: none;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
        }

        .remove-image:hover {
            background: rgba(239, 68, 68, 1);
            transform: scale(1.1);
        }

        .btn-primary {
            background: #124369;
            border: none;
            border-radius: 12px;
            padding: 0.8rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            background: linear-gradient(135deg, #5a67d8, #6b46c1);
        }

        .btn-secondary {
            background: #6b7280;
            border: none;
            border-radius: 12px;
            padding: 0.8rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #4b5563;
            transform: translateY(-2px);
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
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

        .alert-danger {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(220, 38, 38, 0.1));
            color: #dc2626;
            border-left: 4px solid #dc2626;
        }

        .file-upload-area {
            border: 2px dashed #124369;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            background: rgba(102, 126, 234, 0.05);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-upload-area:hover {
            background: rgba(102, 126, 234, 0.1);
            border-color: #124369;
        }

        .file-upload-icon {
            font-size: 3rem;
            color: #124369;
            margin-bottom: 1rem;
        }

        .form-text {
            color: #6b7280;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .progress-indicator {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
            z-index: 1000;
        }


        @media (max-width: 768px) {
            .main-container {
                padding: 1rem;
            }

            .form-section {
                padding: 1.5rem;
            }

            .card-header {
                padding: 1.5rem;
            }

            .preview-images {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
@include('includes.navbar')

<div class="container main-container">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            <div class="card form-card border-dark">
                <div class="card-header">
                    <h3><i class="fas fa-edit me-2"></i>Edytuj nieruchomość</h3>
                    <div class="subtitle">Zaktualizuj informacje o swojej nieruchomości</div>
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

                    <form action="{{ route('properties.update', $property->id) }}" method="POST" enctype="multipart/form-data" id="propertyForm">
                        @csrf
                        @method('PUT')

                        <!-- Dane lokalizacyjne -->
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
                                           value="{{ old('country', $property->country) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="region" class="form-label">
                                        <i class="fas fa-map me-1"></i> Województwo
                                    </label>
                                    <input type="text" class="form-control" id="region" name="region"
                                           value="{{ old('region', $property->region) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="town" class="form-label">
                                        <i class="fas fa-city me-1"></i> Miasto
                                    </label>
                                    <input type="text" class="form-control" id="town" name="town"
                                           value="{{ old('town', $property->town) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="postal_code" class="form-label">
                                        <i class="fas fa-mail-bulk me-1"></i> Kod pocztowy
                                    </label>
                                    <input type="text" class="form-control" id="postal_code" name="postal_code"
                                           value="{{ old('postal_code', $property->postal_code) }}" placeholder="00-000" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="street" class="form-label">
                                        <i class="fas fa-road me-1"></i> Ulica
                                    </label>
                                    <input type="text" class="form-control" id="street" name="street"
                                           value="{{ old('street', $property->street) }}" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="building_number" class="form-label">
                                        <i class="fas fa-building me-1"></i> Nr budynku
                                    </label>
                                    <input type="text" class="form-control" id="building_number" name="building_number"
                                           value="{{ old('building_number', $property->building_number) }}" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="apartment_number" class="form-label">
                                        <i class="fas fa-door-open me-1"></i> Nr mieszkania
                                    </label>
                                    <input type="number" class="form-control" id="apartment_number" name="apartment_number"
                                           value="{{ old('apartment_number', $property->apartment_number) }}">
                                </div>
                            </div>
                        </div>

                        <!-- Dane techniczne -->
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
                                        <option value="Dom" {{ old('type', $property->type) == 'Dom' ? 'selected' : '' }}>Dom</option>
                                        <option value="Mieszkanie" {{ old('type', $property->type) == 'Mieszkanie' ? 'selected' : '' }}>Mieszkanie</option>
                                        <option value="Lokal użytkowy" {{ old('type', $property->type) == 'Lokal użytkowy' ? 'selected' : '' }}>Lokal użytkowy</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="surface" class="form-label">
                                        <i class="fas fa-ruler-combined me-1"></i> Powierzchnia (m²)
                                    </label>
                                    <input type="number" step="0.01" class="form-control" id="surface" name="surface"
                                           value="{{ old('surface', $property->surface) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="number_of_rooms" class="form-label">
                                        <i class="fas fa-bed me-1"></i> Liczba pokoi
                                    </label>
                                    <input type="number" class="form-control" id="number_of_rooms" name="number_of_rooms"
                                           value="{{ old('number_of_rooms', $property->number_of_rooms) }}" min="1" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="floor" class="form-label">
                                        <i class="fas fa-layer-group me-1"></i> Piętro
                                    </label>
                                    <input type="number" class="form-control" id="floor" name="floor"
                                           value="{{ old('floor', $property->floor) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="technical_condition" class="form-label">
                                        <i class="fas fa-tools me-1"></i> Stan techniczny
                                    </label>
                                    <select class="form-select" id="technical_condition" name="technical_condition" required>
                                        <option value="">Wybierz stan</option>
                                        <option value="Do remontu" {{ old('technical_condition', $property->technical_condition) == 'Do remontu' ? 'selected' : '' }}>Do remontu</option>
                                        <option value="Do kapitalnego remontu" {{ old('technical_condition', $property->technical_condition) == 'Do kapitalnego remontu' ? 'selected' : '' }}>Do kapitalnego remontu</option>
                                        <option value="Budynek w stanie surowym" {{ old('technical_condition', $property->technical_condition) == 'Budynek w stanie surowym' ? 'selected' : '' }}>Budynek w stanie surowym</option>
                                        <option value="Gotowy do zamieszkania" {{ old('technical_condition', $property->technical_condition) == 'Gotowy do zamieszkania' ? 'selected' : '' }}>Gotowy do zamieszkania</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="furnishings" class="form-label">
                                        <i class="fas fa-couch me-1"></i> Umeblowanie
                                    </label>
                                    <select class="form-select" id="furnishings" name="furnishings" required>
                                        <option value="">Wybierz opcję</option>
                                        <option value="Nieumeblowane" {{ old('furnishings', $property->furnishings) == 'Nieumeblowane' ? 'selected' : '' }}>Nieumeblowane</option>
                                        <option value="Częściowo umeblowane" {{ old('furnishings', $property->furnishings) == 'Częściowo umeblowane' ? 'selected' : '' }}>Częściowo umeblowane</option>
                                        <option value="W pełni umeblowane" {{ old('furnishings', $property->furnishings) == 'W pełni umeblowane' ? 'selected' : '' }}>W pełni umeblowane</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Dane oferty -->
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
                                           value="{{ old('offer_title', $property->offer_title) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="offer_type" class="form-label">
                                        <i class="fas fa-tools me-1 "></i> Typ ogłoszenia
                                    </label>
                                    <select class="form-select" id="offer_type" name="offer_type" required>
                                        <option value="">Wybierz stan</option>
                                        <option value="Sprzedaż" {{ old('offer_type') == 'Sprzedaż' ? 'selected' : '' }}>Sprzedaż</option>
                                        <option value="Wynajem" {{ old('offer_type') == 'Wynajem' ? 'selected' : '' }}>Wynajem</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="description" class="form-label">
                                        <i class="fas fa-align-left me-1"></i> Opis
                                    </label>
                                    <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description', $property->description) }}</textarea>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="price" class="form-label">
                                        <i class="fas fa-money-bill-wave me-1"></i> Cena (zł)
                                    </label>
                                    <input type="number" class="form-control" id="price" name="price"
                                           value="{{ old('price', $property->price) }}" min="0" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="deposit" class="form-label">
                                        <i class="fas fa-shield-alt me-1"></i> Kaucja (zł)
                                    </label>
                                    <input type="number" class="form-control" id="deposit" name="deposit"
                                           value="{{ old('deposit', $property->deposit) }}" min="0" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="rent" class="form-label">
                                        <i class="fas fa-receipt me-1"></i> Czynsz (zł)
                                    </label>
                                    <input type="number" class="form-control" id="rent" name="rent"
                                           value="{{ old('rent', $property->rent) }}" min="0" required>
                                </div>
                            </div>
                        </div>

                        <!-- Zdjęcia -->
                        <div class="form-section">
                            <h5 class="section-title">
                                <div class="section-icon">
                                    <i class="fas fa-camera"></i>
                                </div>
                                Zdjęcia nieruchomości
                            </h5>

                            <!-- Istniejące zdjęcia -->
                            @if($property->pictures && count($property->pictures) > 0)
                                <div class="mb-4">
                                    <label class="form-label">
                                        <i class="fas fa-images me-1 text-success"></i>
                                        Aktualne zdjęcia ({{ count($property->pictures) }})
                                    </label>
                                    <div class="preview-images" id="existingImages">
                                        @foreach($property->pictures as $index => $picture)
                                            <div class="preview-image existing-image" data-picture-id="{{ $picture->id }}">
                                                <img src="{{ Storage::url($picture->path) }}" alt="Zdjęcie nieruchomości">
                                                <button type="button" class="remove-image" onclick="removeExistingImage({{ $picture->id }}, this)" title="Usuń zdjęcie">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                                <div class="image-label">Istniejące</div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="deleted_pictures" id="deletedPictures" value="">
                                </div>
                            @endif

                            <!-- Nowe zdjęcia -->
                            <div class="mb-3">
                                <label for="pictures" class="form-label">Dodaj nowe zdjęcia (opcjonalne)</label>
                                <input type="file" class="form-control" id="pictures" name="pictures[]"
                                       multiple accept="image/*">
                                <div class="form-text">Maksymalny rozmiar: 2MB na zdjęcie.</div>
                            </div>
                            <div id="imagePreview" class="preview-images"></div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('properties.show', $property->id) }}" class="btn btn-secondary me-md-2">Anuluj</a>
                            <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let deletedPictures = [];

    // Obsługa nowych zdjęć
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
                        <button type="button" class="remove-image" onclick="removeNewImage(${index})">×</button>
                    `;
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            }
        });
    });

    // Usuwanie nowych zdjęć
    function removeNewImage(index) {
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

    // Usuwanie istniejących zdjęć
    function removeExistingImage(pictureId, button) {
        // Dodaj ID do listy usuniętych zdjęć
        deletedPictures.push(pictureId);
        document.getElementById('deletedPictures').value = deletedPictures.join(',');

        // Usuń element z DOM
        button.parentElement.remove();
    }
</script>
</body>
@include('includes.footer')
</html>
