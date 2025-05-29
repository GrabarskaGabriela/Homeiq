@extends('admin.layout')

@section('title', 'Raporty Użytkowników')
@section('page-title', 'Raporty Użytkowników')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Eksportuj Raporty Użytkowników</h5>
                    <div>
                        <form method="GET" action="{{ route('admin.export-report') }}" class="d-inline">
                            <input type="hidden" name="type" value="users">
                            <button type="submit" class="btn export-btn text-white me-2">
                                <i class="fas fa-file-excel"></i> Eksportuj Wszystkich
                            </button>
                        </form>
                        <form method="GET" action="{{ route('admin.export-report') }}" class="d-inline">
                            <input type="hidden" name="type" value="top_owners">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-crown"></i> TOP Właściciele
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Aktywność użytkowników -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Aktywność Użytkowników według Ról</h5>
                    <button class="btn btn-sm export-btn text-white" onclick="exportChart('userActivityChart')">
                        <i class="fas fa-download"></i> Eksportuj Wykres
                    </button>
                </div>
                <div class="card-body">
                    <canvas id="userActivityChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Statystyki Rejestracji</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th>Rola</th>
                                <th>Ogółem</th>
                                <th>30 dni</th>
                                <th>7 dni</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($userActivity as $activity)
                                <tr>
                                    <td>
                                        <span class="badge bg-primary">{{ ucfirst($activity->role) }}</span>
                                    </td>
                                    <td><strong>{{ $activity->count }}</strong></td>
                                    <td>
                                        <span class="badge bg-success">+{{ $activity->new_last_30_days }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">+{{ $activity->new_last_7_days }}</span>
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

    <!-- TOP właściciele -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">TOP 20 Najaktywniejszych Właścicieli</h5>
                    <form method="GET" action="{{ route('admin.export-report') }}" class="d-inline">
                        <input type="hidden" name="type" value="top_owners">
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
                                <th>Ranking</th>
                                <th>Właściciel</th>
                                <th>Email</th>
                                <th>Rola</th>
                                <th>Liczba Ofert</th>
                                <th>Data Rejestracji</th>
                                <th>Aktywność</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($topOwners as $index => $owner)
                                <tr>
                                    <td>
                                        @if($index < 3)
                                            <span class="badge bg-warning text-dark fs-6">
                                            <i class="fas fa-medal"></i> {{ $index + 1 }}
                                        </span>
                                        @else
                                            <span class="badge bg-secondary">{{ $index + 1 }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $owner->first_name }} {{ $owner->last_name }}</strong>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $owner->email }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ ucfirst($owner->role) }}</span>
                                    </td>
                                    <td>
                                    <span class="badge bg-success fs-6">
                                        {{ $owner->owned_offers_count }} ofert
                                    </span>
                                    </td>
                                    <td>
                                        <small>{{ $owner->created_at->format('d.m.Y') }}</small><br>
                                        <small class="text-muted">{{ $owner->created_at->diffForHumans() }}</small>
                                    </td>
                                    <td>
                                        @if($owner->owned_offers_count >= 10)
                                            <i class="fas fa-fire text-danger" title="Bardzo aktywny"></i>
                                        @elseif($owner->owned_offers_count >= 5)
                                            <i class="fas fa-chart-line text-success" title="Aktywny"></i>
                                        @else
                                            <i class="fas fa-user text-muted" title="Standardowy"></i>
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

    <!-- Trendy rejestracji -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Trendy Rejestracji (Ostatnie 30 dni)</h5>
                    <div>
                        <button class="btn btn-sm export-btn text-white me-2" onclick="exportChart('registrationChart')">
                            <i class="fas fa-download"></i> Wykres
                        </button>
                        <form method="GET" action="{{ route('admin.export-report') }}" class="d-inline">
                            <input type="hidden" name="type" value="registration_trends">
                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-file-csv"></i> Dane
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="registrationChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Podsumowanie Ostatnich Dni</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h4 class="text-success">{{ $registrationTrends->sum('count') }}</h4>
                                <small class="text-muted">Łącznie w 30 dni</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <h4 class="text-info">{{ number_format($registrationTrends->avg('count'), 1) }}</h4>
                            <small class="text-muted">Średnio dziennie</small>
                        </div>
                    </div>
                    <hr>
                    <div class="small">
                        <strong>Najlepsze dni:</strong>
                        @foreach($registrationTrends->sortByDesc('count')->take(3) as $day)
                            <div class="d-flex justify-content-between">
                                <span>{{ \Carbon\Carbon::parse($day->date)->format('d.m') }}</span>
                                <span class="badge bg-success">{{ $day->count }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
