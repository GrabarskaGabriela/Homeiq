<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oczekujące transakcje</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
@include('includes.navbar')

<div class="container mt-4  text-color">
    <h1 class="mb-4 text-color">Oczekujące transakcje</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($transactions->isEmpty())
        <p>Brak oczekujących transakcji.</p>
    @else
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Oferta</th>
                <th>Użytkownik</th>
                <th>Data transakcji</th>
                <th>Akcje</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->property->offer->offer_title }}</td>
                    <td>{{ $transaction->user->first_name }} {{ $transaction->user->first_name }}</td>
                    <td>{{ $transaction->created_at }}</td>
                    <td>
                        <a href="{{ route('transactions.confirm.show', $transaction->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-check me-2"></i>Zarządzaj
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>

@include('includes.footer')
</body>
</html>
