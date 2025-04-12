<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ustawienia - Homeiq</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="d-flex flex-column min-vh-100">
@include('includes.navbar')

<main class="container my-5">
    <h2 class="mb-4">Ustawienia konta</h2>

    <!-- Sekcja danych osobowych -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Dane osobowe</h5>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="firstName" class="form-label">Imię</label>
                        <input type="text" class="form-control @error('firstName') is-invalid @enderror"
                               id="firstName" name="firstName"
                               value="{{ old('firstName', auth()->user()->first_name) }}">
                        @error('firstName')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="lastName" class="form-label">Nazwisko</label>
                        <input type="text" class="form-control @error('lastName') is-invalid @enderror"
                               id="lastName" name="lastName"
                               value="{{ old('lastName', auth()->user()->last_name) }}">
                        @error('lastName')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">Adres Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email"
                               value="{{ old('email', auth()->user()->email) }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="phone" class="form-label">Numer telefonu</label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                               id="phone" name="phone"
                               value="{{ old('phone', auth()->user()->phone) }}">
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Zapisz zmiany</button>
            </form>
        </div>
    </div>

    <!-- Sekcja zmiany hasła -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Zmiana hasła</h5>
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-circle me-2"></i>
                Aby zmienić hasło, najpierw <a href="{{ route('password.confirm') }}" class="alert-link">potwierdź swoją tożsamość</a>.
            </div>

            @if (session('password_status'))
                <div class="alert alert-success">
                    {{ session('password_status') }}
                </div>
            @endif

            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="current_password" class="form-label">Aktualne hasło</label>
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                           id="current_password" name="current_password">
                    @error('current_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Nowe hasło</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                           id="password" name="password">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Powtórz nowe hasło</label>
                    <input type="password" class="form-control"
                           id="password_confirmation" name="password_confirmation">
                </div>
                <button type="submit" class="btn btn-primary">Zmień hasło</button>
            </form>
        </div>
    </div>

    <!-- Sekcja powiadomień -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Powiadomienia</h5>
            <form action="{{ route('notification-settings.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="emailNotifications"
                           name="email_notifications"
                           @if(old('email_notifications', auth()->user()->email_notifications)) checked @endif>
                    <label class="form-check-label" for="emailNotifications">Powiadomienia email</label>
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="smsNotifications"
                           name="sms_notifications"
                           @if(old('sms_notifications', auth()->user()->sms_notifications)) checked @endif>
                    <label class="form-check-label" for="smsNotifications">Powiadomienia SMS</label>
                </div>
                <button type="submit" class="btn btn-primary">Aktualizuj powiadomienia</button>
            </form>
        </div>
    </div>
</main>

@include('includes.footer')
</body>
</html>
