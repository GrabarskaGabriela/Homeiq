<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raporty Użytkowników</title>
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
    <h2>Raporty Użytkowników</h2>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.properties') }}">Nieruchomości</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('admin.users') }}">Użytkownicy</a></li>
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
                    <h5 class="mb-0">Eksportuj Użytkowników</h5>
                    <form method="GET" action="{{ route('admin.export-report') }}" class="d-inline">
                        <input type="hidden" name="type" value="users">
                        <button type="submit" class="btn export-btn text-white">
                            <i class="fas fa-file-csv"></i> Eksportuj Wszystko
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Role Analysis Chart and Table -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Analiza Ról Użytkowników</h5>
                    <button class="btn btn-sm export-btn text-white" onclick="exportChart('roleAnalysisChart')">
                        <i class="fas fa-download"></i> Eksportuj Wykres
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <canvas id="roleAnalysisChart"></canvas>
                        </div>
                        <div class="col-md-4">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead class="table-light">
                                    <tr>
                                        <th>Rola</th>
                                        <th>Ilość</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($roleAnalysis as $role)
                                        <tr>
                                            <td>{{ $role->role }}</td>
                                            <td>{{ $role->count }}</td>
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

    <!-- Users Table -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Lista Użytkowników</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Imię i Nazwisko</th>
                                <th>Email</th>
                                <th>Rola</th>
                                <th>Liczba Ofert</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->full_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><span class="badge {{ $user->role == 'admin' ? 'bg-success' : 'bg-info' }}">{{ $user->role }}</span></td>
                                    <td>{{ $user->offers->count() }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $users->links() }}
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
                    <form method="GET" action="{{ route('admin.users') }}">
                        <div class="row g-3">
                            <div class="col-md-2">
                                <label class="form-label">Rola</label>
                                <select name="role" class="form-select">
                                    <option value="">Wszystkie</option>
                                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Imię/Nazwisko</label>
                                <input type="text" name="name" class="form-control" value="{{ request('name') }}" placeholder="Imię lub nazwisko">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">&nbsp;</label>
                                <div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-filter"></i> Filtruj
                                    </button>
                                    <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary">Reset</a>
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
    const roleData = @json($roleAnalysis);
    const roleCtx = document.getElementById('roleAnalysisChart').getContext('2d');

    const roleChart = new Chart(roleCtx, {
        type: 'pie',
        data: {
            labels: roleData.map(item => item.role),
            datasets: [{
                label: 'Liczba Użytkowników',
                data: roleData.map(item => item.count),
                backgroundColor: ['rgba(40, 167, 69, 0.6)', 'rgba(23, 162, 184, 0.6)'],
                borderColor: ['rgba(40, 167, 69, 1)', 'rgba(23, 162, 184, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });

    function exportChart(chartId) {
        const chart = chartId === 'roleAnalysisChart' ? roleChart : null;
        if (chart) {
            const link = document.createElement('a');
            link.download = 'analiza_rol_uzytkownikow.png';
            link.href = chart.toBase64Image();
            link.click();
        }
    }
</script>
</body>
</html>
