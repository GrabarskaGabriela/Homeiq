@extends('admin.layout')

@section('title', 'Raporty Nieruchomości')
@section('page-title', 'Raporty Nieruchomości')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Eksportuj Wszystkie Raporty Nieruchomości</h5>
                    <form method="GET" action="{{ route('admin.export-report') }}" class="d-inline">
                        <input type="hidden" name="type" value="properties">
                        <button type="submit" class="btn export-btn text-white">
                            <i class="fas fa-file-excel"></i> Eksportuj Wszystko do CSV
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Analiza powierzchni -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Analiza Powierzchni Nieruchomości</h5>
                    <button class="btn btn-sm export-btn text-white" onclick="exportChart('surfaceChart')">
                        <i class="fas fa-download"></i> Eksportuj Wykres
                    </button>
                </div>
                <div class="card-body">
                    <canvas id="surfaceChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Szczegóły Powierzchni</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th>Kategoria</th>
                                <th>Ilość</th>
                                <th>Śr. pow.</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($surfaceAnalysis as $surface)
                                <tr>
                                    <td>{{ $surface->surface_category }}</td>
                                    <td><span class="badge bg-primary">{{ $surface->count }}</span></td>
                                    <td>{{ number_format($surface->avg_surface, 1) }}m²</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stan techniczny -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Stan Techniczny</h5>
                    <button class="btn btn-sm export-btn text-white" onclick="exportChart('technicalChart')">
                        <i class="fas fa-download"></i> Eksportuj
                    </button>
                </div>
                <div class="card-body">
                    <canvas id="technicalChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Regiony TOP 10 -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">TOP 10 Regionów</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                            <tr>
                                <th>Region</th>
                                <th>Miasto</th>
                                <th>Liczba</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($regionStats->take(10) as $region)
                                <tr>
                                    <td>{{ $region->region }}</td>
                                    <td>{{ $region->town }}</td>
                                    <td>
                                        <span class="badge bg-success">{{ $region->count }}</span>
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

    <!-- Analiza typu vs pokoje -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Analiza: Typ Nieruchomości vs Liczba Pokoi</h5>
                    <form method="GET" action="{{ route('admin.export-report') }}" class="d-inline">
                        <input type="hidden" name="type" value="type_rooms_analysis">
                        <button type="submit" class="btn btn-sm export-btn text-white">
                            <i class="fas fa-file-csv"></i> Eksportuj CSV
                        </button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                            <tr>
                                <th>Typ Nieruchomości</th>
                                <th>Liczba Pokoi</th>
                                <th>Ilość Nieruchomości</th>
                                <th>Średnia Powierzchnia</th>
                                <th>Powierzchnia na Pokój</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($typeRoomsAnalysis as $analysis)
                                <tr>
                                    <td>
                                        <span class="badge bg-info">{{ $analysis->type }}</span>
                                    </td>
                                    <td>{{ $analysis->number_of_rooms ?? 'N/A' }}</td>
                                    <td>{{ $analysis->count }}</td>
                                    <td>{{ number_format($analysis->avg_surface, 1) }}m²</td>
                                    <td>
                                        @if($analysis->number_of_rooms && $analysis->number_of_rooms > 0)
                                            {{ number_format($analysis->avg_surface / $analysis->number_of_rooms, 1) }}m²
                                        @else
                                            N/A
                                        @endif
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

    <!-- Filtry i wyszukiwanie -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Filtry Zaawansowane</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.property-reports') }}">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Typ Nieruchomości</label>
                                <select name="property_type" class="form-select">
                                    <option value="">Wszystkie</option>
                                    <option value="Dom">Dom</option>
                                    <option value="Mieszkanie">Mieszkanie</option>
                                    <option value="Działka">Działka</option>
                                    <option value="Lokal">Lokal</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Powierzchnia od</label>
                                <input type="number" name="surface_from" class="form-control" placeholder="m²">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Powierzchnia do</label>
                                <input type="number" name="surface_to" class="form-control" placeholder="m²">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">&nbsp;</label>
                                <div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-filter"></i> Filtruj
                                    </button>
                                    <a href="{{ route('admin.property-reports') }}" class="btn btn-outline-secondary">
                                        Resetuj
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Wykres powierzchni
        const surfaceData = @json($surfaceAnalysis);
        const surfaceCtx = document.getElementById('surfaceChart').getContext('2d');
        const surfaceChart = new Chart(surfaceCtx, {
            type: 'bar',
            data: {
                labels: surfaceData.map(item => item.surface_category),
                datasets: [{
                    label: 'Liczba Nieruchomości',
                    data: surfaceData.map(item => item.count),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 205, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Wykres stanu technicznego
        const technicalData = @json($technicalCondition);
        const technicalCtx = document.getElementById('technicalChart').getContext('2d');
        const technicalChart = new Chart(technicalCtx, {
            type: 'pie',
            data: {
                labels: technicalData.map(item => item.technical_condition || 'Nie określono'),
                datasets: [{
                    data: technicalData.map(item => item.count),
                    backgroundColor: [
                        '#36A2EB',
                        '#4BC0C0',
                        '#FFCE56',
                        '#FF6384',
                        '#9966FF',
                        '#FF9F40'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Funkcja eksportu wykresów
        function exportChart(chartType) {
            let chart;
            let filename;

            switch(chartType) {
                case 'surfaceChart':
                    chart = surfaceChart;
                    filename = 'analiza_powierzchni.png';
                    break;
                case 'technicalChart':
                    chart = technicalChart;
                    filename = 'stan_techniczny.png';
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
@endpush
