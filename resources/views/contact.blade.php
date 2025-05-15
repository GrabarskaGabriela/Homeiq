<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pomoc - Homeiq</title>
    <link href="../includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
    </style>
</head>
<body>
@include('includes.navbar')

<main class="container mt-3">
    <div class="card shadow-sm border-dark">
        <div class="card-header text-white" style="background: linear-gradient(135deg, #2b2b2b 0%, #3c3c3c 100%);">
            <h2 class="mb-0">Kontakt z administracją</h2>
        </div>
        <div class="card-body">
            <p>Masz pytania, problemy lub sugestie? Napisz do nas – chętnie pomożemy!</p>
            <p class="text-start text-color mb-4 fst-italic">
                Dział Obsługi Klienta <br>
                Kontakt w dni robocze w godz. 9-17.<br>
                tel.: +48 123-456-789<br>
                e-mail: support@homeiq.pl
            </p>
            <p class="text-start text-color mb-4 fst-italic">Wydawca portalu<br>
                Homeiq - Nieruchomości,<br>
                ul. Sejmowa 5A, 59-220 Legnica<br>
                REGON: 111111111, NIP: 111-11-11-111
            </p>
            <form action="submit_help.php" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Twoje imię</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Wpisz swoje imię">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Twój email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Wpisz swój email">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Wiadomość</label>
                    <textarea class="form-control" id="message" name="message" rows="5" placeholder="Napisz swoją wiadomość"></textarea>
                </div>
                <button type="submit" class="btn text-white"  style="background: linear-gradient(135deg, #2b2b2b 0%, #3c3c3c 100%); border-radius: 30px;">Wyślij wiadomość</button>
            </form>
        </div>
    </div>
</main>

@include('includes.footer')
<script src="../includes/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
