<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Regulamin serwisu - Homeiq</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="d-flex flex-column min-vh-100">
@include('includes.navbar')

<main class="container flex-grow-1 my-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h1 class="card-title mb-4">Regulamin serwisu</h1>

            <!-- Tutaj treść regulaminu -->
            <div class="content">
                <p>Pełna treść regulaminu serwisu...</p>
                <!-- Dodaj więcej sekcji regulaminu -->
            </div>

            <div class="text-center mt-4">
                <a href="{{ url()->previous() }}" class="btn btn-primary">Powrót</a>
            </div>
        </div>
    </div>
</main>

@include('includes.footer')
</body>
</html>
