<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homeiq - rejestracja</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="d-flex flex-column min-vh-100">
@include('includes.navbar')

<main class="container flex-grow-1 my-5">
    <div class="card shadow-sm mx-auto" style="max-width: 500px;">
        <div class="card-body">
            <h3 class="card-title text-center mb-4">Rejestracja</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- First Name -->
                <div class="mb-3">
                    <label for="first_name" class="form-label">Imię</label>
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                           id="first_name" name="first_name"
                           value="{{ old('first_name') }}"
                           placeholder="Wpisz swoje imię" required>
                    @error('firstName')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Last Name -->
                <div class="mb-3">
                    <label for="last_name" class="form-label">Nazwisko</label>
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                           id="last_name" name="last_name"
                           value="{{ old('last_name') }}"
                           placeholder="Wpisz swoje nazwisko" required>
                    @error('last_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div class="mb-3">
                    <label for="phone" class="form-label">Numer telefonu</label>
                    <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                           id="phone" name="phone"
                           value="{{ old('phone') }}"
                           placeholder="Wpisz numer telefonu" required>
                    @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="Wpisz swój email" required>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Hasło</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                           id="password" name="password"
                           placeholder="Wpisz hasło" required>
                    <small class="form-text text-muted">Hasło powinno mieć co najmniej 6 znaków.</small>
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Potwierdź hasło</label>
                    <input type="password" class="form-control"
                           id="password_confirmation" name="password_confirmation"
                           placeholder="Powtórz hasło" required>
                </div>

                <!-- Terms -->
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror"
                           id="terms" name="terms" required>
                    <label class="form-check-label" for="terms">
                        Akceptuję regulamin serwisu
                    </label>
                    @error('terms')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Zarejestruj się</button>
                </div>

                <div class="text-center mt-3">
                    <p>Masz już konto? <a href="{{ route('login') }}">Zaloguj się</a></p>
                </div>
            </form>
        </div>
    </div>
</main>

@include('includes.footer')
</body>
</html>
