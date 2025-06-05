<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raporty Ofert</title>
    @vite(['resources/css/admin.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
@include('includes.admin_navbar')
<div class="container mt-4">

    <!-- Export Buttons -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Eksportuj Raporty Ofert</h5>
                    <div>
                        <form method="GET" action="{{ route('admin.export-report') }}" class="d-inline">
                            <input type="hidden" name="type" value="offers">
                            <button type="submit" class="btn export-btn text-white me-2">
                                <i class="fas fa-file-csv"></i> Eksportuj Wszystko
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Filters -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Filtry Zaawansowane</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.offers') }}">
                        <div class="row g-3">
                            <div class="col-md-2">
                                <label class="form-label">Typ Oferty</label>
                                <select name="offer_type" class="form-select">
                                    <option value="">Wszystkie</option>
                                    <option
                                        value="Sprzedaż" {{ request('offer_type') == 'Sprzedaż' ? 'selected' : '' }}>
                                        Sprzedaż
                                    </option>
                                    <option value="Wynajem" {{ request('offer_type') == 'Wynajem' ? 'selected' : '' }}>
                                        Wynajem
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Cena od</label>
                                <input type="number" name="price_from" class="form-control"
                                       value="{{ request('price_from') }}" placeholder="PLN">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Cena do</label>
                                <input type="number" name="price_to" class="form-control"
                                       value="{{ request('price_to') }}" placeholder="PLN">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Data od</label>
                                <input type="date" name="date_from" class="form-control"
                                       value="{{ request('date_from') }}">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">&nbsp;</label>
                                <div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-filter"></i> Filtruj
                                    </button>
                                    <a href="{{ route('admin.offers') }}" class="btn btn-outline-secondary">Reset</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Expensive Offers Table -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">TOP 20 Najdroższych Ofert</h5>
                    <form method="GET" action="{{ route('admin.export-report') }}" class="d-inline">
                        <input type="hidden" name="type" value="expensive_offers">
                        <button type="submit" class="btn btn-sm export-btn text-white">
                            <i class="fas fa-file-csv"></i> Eksportuj CSV
                        </button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Typ Oferty</th>
                                <th>Typ Nieruchomości</th>
                                <th>Lokalizacja</th>
                                <th>Powierzchnia</th>
                                <th>Właściciel</th>
                                <th>Cena</th>
                                <th>Kaucja</th>
                                <th>Czynsz</th>
                                <th>Cena za m²</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($expensiveOffers as $index => $offer)
                                <tr>
                                    <td><span class="badge bg-warning text-dark">{{ $index + 1 }}</span></td>
                                    <td><strong class="text-success">{{ number_format($offer->price, 0) }} zł</strong>
                                    </td>
                                    <td>
                                                <span
                                                    class="badge {{ $offer->offer_type == 'Sprzedaż' ? 'bg-success' : 'bg-info' }}">
                                                    {{ $offer->offer_type }}
                                                </span>
                                    </td>
                                    <td>{{ $offer->property ? $offer->property->type : 'N/A' }}</td>
                                    <td>
                                        <small
                                            class="text-muted">{{ $offer->property ? $offer->property->region : 'N/A' }}</small><br>
                                        <strong>{{ $offer->property ? $offer->property->town : 'N/A' }}</strong>
                                    </td>
                                    <td>{{ $offer->property ? $offer->property->surface : 'N/A' }} m²</td>
                                    <td>{{ $offer->owner ? $offer->owner->full_name : 'N/A' }}</td>
                                    <td>
                                                <span class="badge bg-secondary">
                                                    {{ $offer->property ? number_format($offer->price / $offer->property->surface, 0) : 'N/A' }} zł/m²
                                                </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
