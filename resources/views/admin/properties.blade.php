<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raporty Nieruchomości</title>
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
    <h2>Raporty Nieruchomości</h2>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('admin.properties') }}">Nieruchomości</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.users') }}">Użytkownicy</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.offers') }}">Oferty</a></li>
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
                    <h5 class="mb-0">Eksportuj Nieruchomości</h5>
                    <form method="GET" action="{{ route('admin.export-report') }}" class="d-inline">
                        <input type="hidden" name="type" value="properties">
                        <button type="submit" class="btn export-btn text-white">
                            <i class="fas fa-file-csv"></i> Eksportuj Wszystko
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Type Analysis Chart and Table -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Analiza Typów Nieruchomości</h5>
                    <button class="btn btn-sm export-btn text-white" onclick="exportChart('typeAnalysisChart')">
                        <i class="fas fa-download"></i> Eksportuj Wykres
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <canvas id="typeAnalysisChart"></canvas>
                        </div>
                        <div class="col-md-4">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead class="table-light">
                                    <tr>
                                        <th>Typ</th>
                                        <th>Ilość</th>
                                        <th>Śr. Powierzchnia</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($typeAnalysis as $type)
                                        <tr>
                                            <td>{{ $type->type }}</td>
                                            <td>{{ $type->count }}</td>
                                            <td>{{ number_format($type->avg_surface, 1) }} m²</td>
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

    <!-- Properties Table -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Lista Nieruchomości</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Typ</th>
                                <th>Miasto</th>
                                <th>Powierzchnia</th>
                                <th>Liczba Pokoi</th>
                                <th>Cena Oferty</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($properties as $property)
                                <tr>
                                    <td>{{ $property->id }}</td>
                                    <td>{{ $property->type }}</td>
                                    <td>{{ $property->town }}</td>
                                    <td>{{ $property->surface }} m²</td>
                                    <td>{{ $property->number_of_rooms }}</td>
                                    <td>{{ $property->offer ? number_format($property->offer->price, 0) . ' zł' : 'Brak' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $properties->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Filtry</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.properties') }}">
                        <div class="row g-3">
                            <div class="col-md-2">
                                <label class="form-label">Typ</label>
                                <select name="type" class="form-select">
                                    <option value="">Wszystkie</option>
                                    <option value="Mieszkanie" {{ request('type') == 'Mieszkanie' ? 'selected' : '' }}>Mieszkanie</option>
                                    <option value="Dom" {{ request('type') == 'Dom' ? 'selected' : '' }}>Dom</option>
                                    <option value="Działka" {{ request('type') == 'Działka' ? 'selected' : '' }}>Działka</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Miasto</label>
                                <input type="text" name="town" class="form-control" value="{{ request('town') }}" placeholder="Nazwa miasta">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Powierzchnia od</label>
                                <input type="number" name="surface_from" class="form-control" value="{{ request('surface_from') }}" placeholder="m²">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Powierzchnia do</label>
                                <input type="number" name="surface_to" class="form-control" value="{{ request('surface_to') }}" placeholder="m²">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">&nbsp;</label>
                                <div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-filter"></i> Filtruj
                                    </button>
                                    <a href="{{ route('admin.properties') }}" class="btn btn-outline-secondary">Reset</a>
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
    const typeData = @json($typeAnalysis);
    const typeCtx = document.getElementById('typeAnalysisChart').getContext('2d');

    const typeChart = new Chart(typeCtx, {
        type: 'bar',
        data: {
            labels: typeData.map(item => item.type),
            datasets: [{
                label: 'Liczba Nieruchomości',
                data: typeData.map(item => item.count),
                backgroundColor: 'rgba(40, 167, 69, 0.6)',
                borderColor: 'rgba(40, 167, 69, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    function exportChart(chartId) {
        const chart = chartId === 'typeAnalysisChart' ? typeChart : null;
        if (chart) {
            const link = document.createElement('a');
            link.download = 'analiza_typow_nieruchomosci.png';
            link.href = chart.toBase64Image();
            link.click();
        }
    }
</script>
</body>
</html>
