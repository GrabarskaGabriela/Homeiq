@extends('admin.layout')

@section('title', 'Raporty Ofert')
@section('page-title', 'Raporty Ofert')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Eksportuj Raporty Ofert</h5>
                    <div>
                        <form method="GET" action="{{ route('admin.export-report') }}" class="d-inline">
                            <input type="hidden" name="type" value="offers">
                            <button type="submit" class="btn export-btn text-white me-2">
                                <i class="fas fa-file-excel"></i> Eksportuj Wszystko
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

    <!-- Analiza cen według typu oferty -->
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

    <!-- Najdroższe oferty -->
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
                                    <td>
                                        <span class="badge bg-warning text-dark">{{ $index + 1 }}</span>
                                    </td>
                                    <td>
                                        <strong class="text-success">
                                            {{ number_format($offer->price, 0) }} zł
                                        </strong>
                                    </td>
                                    <td>
                                    <span class="badge {{ $offer->offer_type == 'Sprzedaż' ? 'bg-success' : 'bg-info' }}">
                                        {{ $offer->offer_type }}
                                    </span>
                                    </td>
                                    <td>{{ $offer->property->type }}</td>
                                    <td>
                                        <small class="text-muted">{{ $offer->property->region }}</small><br>
                                        <strong>{{ $offer->property->town }}</strong>
                                    </td>
                                    <td>{{ $offer->property->surface }}m²</td>
                                    <td>
                                        {{ $offer->owner->first_name }} {{ $offer->owner->last_name }}
                                    </td>
                                    <td>
                                    <span class="badge bg-secondary">
                                        {{ number_format($offer->price / $offer->property->surface, 0) }} zł/m²
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

    <!-- Analiza cen według miast -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Analiza Cen według Miast (min. 2 oferty)</h5>
                    <form method="GET" action="{{ route('admin.export-report') }}" class="d-inline">
                        <input type="hidden" name="type" value="city_price_analysis">
                        <button type="submit" class="btn btn-sm export-btn text-white">
                            <i class="fas fa-file-csv"></i> Eksportuj CSV
                        </button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-light">
                            <tr>
                                <th>Miasto</th>
                                <th>Typ Oferty</th>
                                <th>Liczba Ofert</th>
                                <th>Średnia Cena</th>
                                <th>Średnia Powierzchnia</th>
                                <th>Cena za m²</th>
                                <th>Ranking</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cityPriceAnalysis as $index => $city)
                                <tr>
                                    <td><strong>{{ $city->town }}</strong></td>
                                    <td>
                                    <span class="badge {{ $city->offer_type == 'Sprzedaż' ? 'bg-success' : 'bg-info' }}">
                                        {{ $city->offer_type }}
                                    </span>
                                    </td>
                                    <td>{{ $city->count }}</td>
                                    <td>{{ number_format($city->avg_price, 0) }} zł</td>
                                    <td>{{ number_format($city->avg_surface, 1) }}m²</td>
                                    <td>
                                    <span class="badge bg-primary">
                                        {{ number_format($city->price_per_m2, 0) }} zł/m²
                                    </span>
                                    </td>
                                    <td>
                                        @if($index < 3)
                                            <i class="fas fa-medal text-warning"></i>
                                        @elseif($index < 10)
                                            <i class="fas fa-arrow-up text-success"></i>
                                        @else
                                            <i class="fas fa-minus text-muted"></i>
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

    <!-- Trendy cen w czasie -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Trendy Cen w Czasie</h5>
                    <div>
                        <button class="btn btn-sm export-btn text-white me-2" onclick="exportChart('priceTrendsChart')">
                            <i class="fas fa-download"></i> Eksportuj Wykres
                        </button>
                        <form method="GET" action="{{ route('admin.export-report') }}" class="d-inline">
                            <input type="hidden" name="type" value="price_trends">
                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-file-csv"></i> Eksportuj Dane
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="priceTrendsChart"></canvas>

                    <!-- Tabela z ostatnimi trendami -->
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
                                    <th>Zmiana</th>
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
                                        <td>
                                            <i class="fas fa-chart-line text-success"></i>
                                            <small class="text-muted">trend</small>
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

    <!-- Filtry -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Filtry Zaawansowane</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.offer-reports') }}">
                        <div class="row g-3">
                            <div class="col-md-2">
                                <label class="form-label">Typ Oferty</label>
                                <select name="offer_type" class="form-select">
                                    <option value="">Wszystkie</option>
                                    <option value="Sprzedaż">Sprzedaż</option>
                                    <option value="Wynajem">Wynajem</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Cena od</label>
                                <input type="number" name="price_from" class="form-control" placeholder="PLN">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Cena do</label>
                                <input type="number" name="price_to" class="form-control" placeholder="PLN">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Miasto</label>
                                <input type="text" name="city" class="form-control" placeholder="Nazwa miasta">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Data od</label>
                                <input type="date" name="date_from" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">&nbsp;</label>
                                <div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-filter"></i> Filtruj
                                    </button>
                                    <a href="{{ route('admin.offer-reports') }}" class="btn btn-outline-secondary">
                                        Reset
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
        // Wykres analizy cen
        const priceData = @json($priceAnalysis);
        const priceCtx = document.getElementById('priceAnalysisChart').getContext('2d');

        // Grupowanie danych według typu oferty
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

        // Wykres trendów cenowych
        const trendsData = @json($priceTrends);
        const trendsCtx = document.getElementById('priceTrendsChart').getContext('2d');

        // Przygotowanie danych dla linii trendów
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

        // Funkcja eksportu wykresów
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
@endpush
