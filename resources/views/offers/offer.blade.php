<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oferta - Homeiq</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('includes.navbar')
</head>
<body>
<main class="container my-5">

    <div class="row mb-4">
        <div class="col">
            <img src="includes/logo.png" alt="Zdjęcie 1" class="img-fluid img-thumbnail">
        </div>
        <div class="col">
            <img src="includes/logo2.png" alt="Zdjęcie 2" class="img-fluid img-thumbnail">
        </div>
        <div class="col">
            <img src="includes/logo.png" alt="Zdjęcie 3" class="img-fluid img-thumbnail">
        </div>
        <div class="col">
            <img src="includes/logo2.png" alt="Zdjęcie 4" class="img-fluid img-thumbnail">
        </div>
        <div class="col">
            <img src="includes/logo.png" alt="Zdjęcie 5" class="img-fluid img-thumbnail">
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h3 class="card-title">Przykładowa oferta nieruchomości</h3>
            <p class="text-muted mb-1"><strong>Państwo:</strong> Polska</p>
            <p class="text-muted mb-1"><strong>Region:</strong> Mazowieckie</p>
            <p class="text-muted mb-1"><strong>Miasto:</strong> Warszawa</p>
            <p class="text-muted mb-1"><strong>Ulica i numer:</strong> Przykładowa 10</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">Opis nieruchomości</h4>
                    <p class="card-text">
                        Jest to przykładowy opis nieruchomości. Tutaj możesz przedstawić wszystkie kluczowe informacje,
                        zalety lokalizacji, dodatkowe wyposażenie czy ciekawostki dotyczące okolicy.
                    </p>
                </div>
            </div>
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">Szczegóły techniczne</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Cena:</strong> 499 000 PLN</li>
                        <li class="list-group-item"><strong>Powierzchnia:</strong> 60 m<sup>2</sup></li>
                        <li class="list-group-item"><strong>Typ nieruchomości:</strong> Mieszkanie</li>
                        <li class="list-group-item"><strong>Liczba pokoi:</strong> 3</li>
                        <li class="list-group-item"><strong>Zabudowa:</strong> Blok</li>
                        <li class="list-group-item"><strong>Wyposażenie:</strong> Częściowo umeblowane</li>
                        <li class="list-group-item"><strong>Stan:</strong> Do zamieszkania</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Kontakt</h5>
                    <p class="card-text mb-2">
                        <strong>Właściciel:</strong> Jan Kowalski
                    </p>
                    <p class="card-text mb-2">
                        <strong>Telefon:</strong> 123 456 789
                    </p>
                    <p class="card-text mb-2">
                        <strong>Email:</strong> jan.kowalski@example.com
                    </p>
                    <p class="card-text">
                        Skontaktuj się, aby uzyskać więcej informacji lub umówić się na prezentację.
                    </p>
                    <button class="btn btn-primary w-100 mb-2" onclick="alert('Zadzwoń do właściciela')">
                        <i class="fas fa-phone"></i> Zadzwoń
                    </button>
                    <button class="btn btn-outline-primary w-100" onclick="alert('Wyślij wiadomość do właściciela')">
                        <i class="fas fa-envelope"></i> Wyślij wiadomość
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

@include('includes.footer')
</body>
</html>
