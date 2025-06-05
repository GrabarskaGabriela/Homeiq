<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raporty Użytkowników</title>
    @vite(['resources/css/admin.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
@include('includes.admin_navbar')
<div class="container mt-4">
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
                                <th>Adres email</th>
                                <th>Numer telefonu</th>
                                <th>Rola</th>
                                <th>Liczba Ofert</th>
                                <th>Data utworzenia konta</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->full_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td><span class="badge {{ $user->role == 'admin' ? 'bg-success' : 'bg-info' }}">{{ $user->role }}</span></td>
                                    <td>{{ $user->offers->count() }}</td>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex flex-column align-items-center mt-4">
                            <div class="mb-2 text-color">
                                {{ $users->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
</div>

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
