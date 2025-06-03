<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homeiq - logowanie</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="d-flex flex-column min-vh-100">
@include('includes.navbar')

<main class="container flex-grow-1 my-5">
    <div class="card shadow-sm mx-auto" style="max-width: 500px;">
        <div class="card-body">
            <h3 class="card-title text-center mb-4">Logowanie</h3>

            @if (session('status'))
                <div class="alert alert-info mb-4">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email"
                           value="{{ old('email') }}"
                           required autofocus autocomplete="username">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Hasło</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                           id="password" name="password"
                           required autocomplete="current-password">
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Zapamiętaj mnie</label>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Zaloguj się</button>
                </div>

                <div class="text-center mt-3">
                    <p>Nie masz jeszcze konta? <a href="{{ route('register') }}">Zarejestruj się</a></p>
                    <p><a href="{{ route('password.request') }}">Zapomniałem hasła</a></p>
                </div>
            </form>
        </div>
    </div>
</main>

@include('includes.footer')
</body>
</html>
