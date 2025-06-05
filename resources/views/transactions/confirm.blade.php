<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potwierdź transakcję</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
@include('includes.navbar')
<body>
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Potwierdź transakcję</h5>
            <p>Oferta: {{ $transaction->property->offer->offer_title }}</p>
            <p>Użytkownik: {{ $transaction->user->first_name }} {{ $transaction->user->last_name }}</p>
            <p>Data transakcji: {{ $transaction->created_at }}</p>

            <form action="{{ route('transactions.confirm', $transaction->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Akcja</label>
                    <select name="action" class="form-select" required>
                        <option value="confirm">Potwierdź transakcję</option>
                        <option value="reject">Odrzuć transakcję</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Wykonaj</button>
            </form>

            @if($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
</body>
@include('includes.footer')
</html>
