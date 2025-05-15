<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twoje ogłoszenia - Homeiq</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@include('includes.navbar')

<main class="container my-5">
    <h2 class="mb-4">Twoje ogłoszenia:</h2>
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="../includes/logo.png" class="card-img-top" alt="Oferta">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Oferta 1</h5>
                    <p class="card-text">Krótki opis oferty...</p>
                    <div class="mt-auto d-flex justify-content-between">
                        <a href="offer.blade.php" class="btn btn-primary btn-sm">Przejdź do oferty</a>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteModal">
                            Skasuj ofertę
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="../includes/logo.png" class="card-img-top" alt="Oferta">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Oferta 2</h5>
                    <p class="card-text">Krótki opis oferty...</p>
                    <div class="mt-auto d-flex justify-content-between">
                        <a href="offer.blade.php" class="btn btn-primary btn-sm">Przejdź do oferty</a>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteModal">
                            Skasuj ofertę
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Potwierdzenie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zamknij"></button>
            </div>
            <div class="modal-body">
                Czy na pewno chcesz skasować ofertę?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nie</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tak</button>
            </div>
        </div>
    </div>
</div>

@include('includes.footer')
</body>
</html>
