<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raporty Ofert</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.min.js"></script>
    <style>
        .export-btn { background-color: #28a745; }
        .export-btn:hover { background-color: #218838; }
        .table-responsive { max-height: 500px; overflow-y: auto; }
    </style>
</head>
<body>
<div class="container mt-4">
    <h2>Raporty Ofert</h2>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.properties') }}">Nieruchomości</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.users') }}">Użytkownicy</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('admin.offers') }}">Oferty</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.transactions') }}">Transakcje</a></li>
                </ul>
            </div>
        </div>
    </nav>

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
                        <form method="GET" action="{{ route('admin.export-report') }}" class="d-inline">
                            <input type="hidden" name="type" value="expensive_offers">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-crown"></i> TOP Oferty
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Price Analysis Chart and Table -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Analiza Cen według Typu Oferty i Nieruchomości</h5>
                    <button class="btn btn-sm export-btn text-white" onclick="exportChart('priceAnalysisChart')">
                        <i class="fas fa-download"></i> Eksportuj Wykres
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <canvas id="priceAnalysisChart"></canvas>
                        </div>
                        <div class="col-md-4">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead class="table-light">
                                    <tr>
                                        <th>Typ Oferty</th>
                                        <th>Typ Nieruchomości</th>
                                        <th>Ilość</th>
                                        <th>Śr. Cena</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($priceAnalysis as $price)
                                        <tr>
                                            <td>
                                                        <span class="badge {{ $price->offer_type == 'Sprzedaż' ? 'bg-success' : 'bg-info' }}">
                                                            {{ $price->offer_type }}
                                                        </span>
                                            </td>
                                            <td>{{ $price->property_type }}</td>
                                            <td>{{ $price->count }}</td>
                                            <td>{{ number_format($price->avg_price, 0) }} zł</td>
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
                                <th>Cena</th>
                                <th>Typ Oferty</th>
                                <th>Typ Nieruchomości</th>
                                <th>Lokalizacja</th>
                                <th>Powierzchnia</th>
                                <th>Właściciel</th>
                                <th>Cena za m²</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($expensiveOffers as $index => $offer)
                                <tr>
                                    <td><span class="badge bg-warning text-dark">{{ $index + 1 }}</span></td>
                                    <td><strong class="text-success">{{ number_format($offer->price, 0) }} zł</strong></td>
                                    <td>
                                                <span class="badge {{ $offer->offer_type == 'Sprzedaż' ? 'bg-success' : 'bg-info' }}">
                                                    {{ $offer->offer_type }}
                                                </span>
                                    </td>
                                    <td>{{ $offer->property ? $offer->property->type : 'N/A' }}</td>
                                    <td>
                                        <small class="text-muted">{{ $offer->property ? $offer->property->region : 'N/A' }}</small><br>
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

    <!-- Price Trends Chart and Table -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Trendy Cen w Czasie</h5>
                    <div>
                        <button class="btn btn-sm export-btn text-white me-2" onclick="exportChart('priceTrendsChart')">
                            <i class="fas fa-download"></i> Eksportuj Wykres
                        </button>
                        <form method="GET" action="{{ route('admin.export-report') }}" class="d-inline">
                            <input type="hidden" name="type" value="offers">
                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-file-csv"></i> Eksportuj Dane
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="priceTrendsChart"></canvas>
                    <div class="mt-4">
                        <h6>Ostatnie Trendy Cenowe</h6>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th>Miesiąc/Rok</th>
                                    <th>Typ Oferty</th>
                                    <th>Średnia Cena</th>
                                    <th>Liczba Ofert</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($priceTrends->take(10) as $trend)
                                    <tr>
                                        <td>{{ str_pad($trend->month, 2, '0', STR_PAD_LEFT) }}/{{ $trend->year }}</td>
                                        <td>
                                                    <span class="badge {{ $trend->offer_type == 'Sprzedaż' ? 'bg-success' : 'bg-info' }}">
                                                        {{ $trend->offer_type }}
                                                    </span>
                                        </td>
                                        <td>{{ number_format($trend->avg_price, 0) }} zł</td>
                                        <td>{{ $trend->count }}</td>
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
                                    <option value="Sprzedaż" {{ request('offer_type') == 'Sprzedaż' ? 'selected' : '' }}>Sprzedaż</option>
                                    <option value="Wynajem" {{ request('offer_type') == 'Wynajem' ? 'selected' : '' }}>Wynajem</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Cena od</label>
                                <input type="number" name="price_from" class="form-control" value="{{ request('price_from') }}" placeholder="PLN">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Cena do</label>
                                <input type="number" name="price_to" class="form-control" value="{{ request('price_to') }}" placeholder="PLN">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Miasto</label>
                                <input type="text" name="city" class="form-control" value="{{ request('city') }}" placeholder="Nazwa miasta">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Data od</label>
                                <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
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
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const priceData = @json($priceAnalysis);
    const priceCtx = document.getElementById('priceAnalysisChart').getContext('2d');

    const sprzedazData = priceData.filter(item => item.offer_type === 'Sprzedaż');
    const wynajemData = priceData.filter(item => item.offer_type === 'Wynajem');
    const propertyTypes = [...new Set(priceData.map(item => item.property_type))];

    const priceChart = new Chart(priceCtx, {
        type: 'bar',
        data: {
            labels: propertyTypes,
            datasets: [
                {
                    label: 'Sprzedaż',
                    data: propertyTypes.map(type => {
                        const item = sprzedazData.find(d => d.property_type === type);
                        return item ? item.avg_price : 0;
                    }),
                    backgroundColor: 'rgba(40, 167, 69, 0.6)',
                    borderColor: 'rgba(40, 167, 69, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Wynajem',
                    data: propertyTypes.map(type => {
                        const item = wynajemData.find(d => d.property_type === type);
                        return item ? item.avg_price : 0;
                    }),
                    backgroundColor: 'rgba(23, 162, 184, 0.6)',
                    borderColor: 'rgba(23, 162, 184, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return new Intl.NumberFormat('pl-PL', {
                                style: 'currency',
                                currency: 'PLN',
                                minimumFractionDigits: 0
                            }).format(value);
                        }
                    }
                }
            }
        }
    });

    const trendsData = @json($priceTrends);
    const trendsCtx = document.getElementById('priceTrendsChart').getContext('2d');

    const sprzedazTrends = trendsData.filter(item => item.offer_type === 'Sprzedaż');
    const wynajemTrends = trendsData.filter(item => item.offer_type === 'Wynajem');
    const allMonths = [...new Set(trendsData.map(item => `${item.month}/${item.year}`))].sort();

    const trendsChart = new Chart(trendsCtx, {
        type: 'line',
        data: {
            labels: allMonths,
            datasets: [
                {
                    label: 'Sprzedaż - Średnia Cena',
                    data: allMonths.map(month => {
                        const [m, y] = month.split('/');
                        const item = sprzedazTrends.find(d => d.month == m && d.year == y);
                        return item ? item.avg_price : null;
                    }),
                    borderColor: 'rgb(40, 167, 69)',
                    backgroundColor: 'rgba(40, 167, 69, 0.1)',
                    tension: 0.1
                },
                {
                    label: 'Wynajem - Średnia Cena',
                    data: allMonths.map(month => {
                        const [m, y] = month.split('/');
                        const item = wynajemTrends.find(d => d.month == m && d.year == y);
                        return item ? item.avg_price : null;
                    }),
                    borderColor: 'rgb(23, 162, 184)',
                    backgroundColor: 'rgba(23, 162, 184, 0.1)',
                    tension: 0.1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return new Intl.NumberFormat('pl-PL', {
                                style: 'currency',
                                currency: 'PLN',
                                minimumFractionDigits: 0
                            }).format(value);
                        }
                    }
                }
            }
        }
    });

    function exportChart(chartType) {
        let chart;
        let filename;

        switch(chartType) {
            case 'priceAnalysisChart':
                chart = priceChart;
                filename = 'analiza_cen_ofert.png';
                break;
            case 'priceTrendsChart':
                chart = trendsChart;
                filename = 'trendy_cenowe.png';
                break;
        }

        if (chart) {
            const link = document.createElement('a');
            link.download = filename;
            link.href = chart.toBase64Image();
            link.click();
        }
    }
</script>
</body>
</html>
