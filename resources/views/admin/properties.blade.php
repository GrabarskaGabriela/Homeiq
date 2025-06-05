<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raporty Nieruchomości</title>
    @vite(['resources/css/admin.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<main>
    @include('includes.admin_navbar')
    <div class="container">
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

        <div class="row mb-5">
            <div class="col-36">
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
                                    <th>Typ nieruchomości</th>
                                    <th>Typ ogłoszenia</th>
                                    <th>Kraj</th>
                                    <th>Województwo</th>
                                    <th>Miasto</th>
                                    <th>Kod pocztowy</th>
                                    <th>Adres</th>
                                    <th>Powierzchnia</th>
                                    <th>Liczba Pokoi</th>
                                    <th>Piętro</th>
                                    <th>Stan techniczny</th>
                                    <th>Umeblowanie</th>
                                    <th>Data utworzenia</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($properties as $property)
                                    <tr>
                                        <td>{{ $property->id }}</td>
                                        <td>{{ $property->type }}</td>
                                        <td>{{ $property->offer->offer_type }}</td>
                                        <td>{{ $property->country }}</td>
                                        <td>{{ $property->region }}</td>
                                        <td>{{ $property->town }}</td>
                                        <td>{{ $property->postal_code }}</td>
                                        <td>
                                            {{ $property->street }} {{ $property->building_number }}
                                            @if ($property->apartment_number)
                                                m.{{ $property->apartment_number }}
                                            @endif
                                        </td>

                                        <td>{{ $property->surface }} m²</td>
                                        <td>{{ $property->number_of_rooms }}</td>
                                        <td>{{ $property->floor }}</td>
                                        <td>{{ $property->technical_condition }}</td>
                                        <td>{{ $property->furnishings }}</td>
                                        <td>{{ $property->offer->created_at }}</td>
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
                                            <th>Typ nieruchomości</th>
                                            <th>Ilość ogłoszeń</th>
                                            <th>Średnia Powierzchnia</th>
                                            <th>Średnia cena za m²</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($typeAnalysis as $type)
                                            <tr>
                                                <td>{{ $type->type }}</td>
                                                <td>{{ $type->count }}</td>
                                                <td>{{ number_format($type->avg_surface, 1) }} m²</td>
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
    </div>
    </div>
</main>
<script>
    // Sample data for the chart
    const typeData = [
        { type: 'Mieszkanie', count: 15, avg_surface: 67.3 },
        { type: 'Dom', count: 8, avg_surface: 125.8 },
        { type: 'Działka', count: 3, avg_surface: 650.0 }
    ];

    const typeCtx = document.getElementById('typeAnalysisChart').getContext('2d');

    const typeChart = new Chart(typeCtx, {
        type: 'bar',
        data: {
            labels: typeData.map(item => item.type),
            datasets: [{
                label: 'Liczba Nieruchomości',
                data: typeData.map(item => item.count),
                backgroundColor: [
                    'rgba(192, 168, 145, 0.8)',
                    'rgba(182, 151, 125, 0.8)',
                    'rgba(111, 78, 55, 0.8)'
                ],
                borderColor: [
                    'rgba(192, 168, 145, 1)',
                    'rgba(182, 151, 125, 1)',
                    'rgba(111, 78, 55, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: '#6f4e37',
                        font: {
                            weight: 'bold'
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#6f4e37'
                    },
                    grid: {
                        color: 'rgba(192, 168, 145, 0.2)'
                    }
                },
                x: {
                    ticks: {
                        color: '#6f4e37'
                    },
                    grid: {
                        color: 'rgba(192, 168, 145, 0.2)'
                    }
                }
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
