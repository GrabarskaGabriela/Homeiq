<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raporty Transakcji</title>
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
    <h2>Raporty Transakcji</h2>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.properties') }}">Nieruchomości</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.users') }}">Użytkownicy</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.offers') }}">Oferty</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('admin.transactions') }}">Transakcje</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Export Buttons -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Eksportuj Transakcje</h5>
                    <form method="GET" action="{{ route('admin.export-report') }}" class="d-inline">
                        <input type="hidden" name="type" value="transactions">
                        <button type="submit" class="btn export-btn text-white">
                            <i class="fas fa-file-csv"></i> Eksportuj Wszystko
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Trend Analysis Chart and Table -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Trendy Transakcji w Czasie</h5>
                    <button class="btn btn-sm export-btn text-white" onclick="exportChart('trendAnalysisChart')">
                        <i class="fas fa-download"></i> Eksportuj Wykres
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <canvas id="trendAnalysisChart"></canvas>
                        </div>
                        <div class="col-md-4">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead class="table-light">
                                    <tr>
                                        <th>Miesiąc/Rok</th>
                                        <th>Liczba Transakcji</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($trendAnalysis as $trend)
                                        <tr>
                                            <td>{{ str_pad($trend->month, 2, '0', STR_PAD_LEFT) }}/{{ $trend->year }}</td>
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
    </div>

    <!-- Transactions Table -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Lista Transakcji</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Data</th>
                                <th>Miasto</th>
                                <th>Właściciel</th>
                                <th>Klient</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ $transaction->transaction_date->format('Y-m-d') }}</td>
                                    <td>{{ $transaction->property ? $transaction->property->town : 'N/A' }}</td>
                                    <td>{{ $transaction->owner ? $transaction->owner->full_name : 'N/A' }}</td>
                                    <td>{{ $transaction->user ? $transaction->user->full_name : 'N/A' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $transactions->links() }}
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
                    <form method="GET" action="{{ route('admin.transactions') }}">
                        <div class="row g-3">
                            <div class="col-md-2">
                                <label class="form-label">Data od</label>
                                <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Data do</label>
                                <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Miasto</label>
                                <input type="text" name="city" class="form-control" value="{{ request('city') }}" placeholder="Nazwa miasta">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">&nbsp;</label>
                                <div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-filter"></i> Filtruj
                                    </button>
                                    <a href="{{ route('admin.transactions') }}" class="btn btn-outline-secondary">Reset</a>
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
    const trendData = @json($trendAnalysis);
    const trendCtx = document.getElementById('trendAnalysisChart').getContext('2d');

    const trendChart = new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: trendData.map(item => `${item.month}/${item.year}`),
            datasets: [{
                label: 'Liczba Transakcji',
                data: trendData.map(item => item.count),
                borderColor: 'rgb(23, 162, 184)',
                backgroundColor: 'rgba(23, 162, 184, 0.1)',
                tension: 0.1
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
        const chart = chartId === 'trendAnalysisChart' ? trendChart : null;
        if (chart) {
            const link = document.createElement('a');
            link.download = 'trendy_transakcji.png';
            link.href = chart.toBase64Image();
            link.click();
        }
    }
</script>
</body>
</html>
