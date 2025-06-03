<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homeiq</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('includes.navbar')
</head>
<body class="text-white">
<main>
    <div class="page-container">
        <section class="hero py-5 text-color text-center">
            <div class="container">
                <h1 class="display-4 fw-bold mb-4">Tysiące chomiczych norek na wyciągnięcie łapki</h1>
                <p class="lead mb-4">Odkryj idealną nieruchomość dla swojej rodziny - kupno, wynajem, sprzedaż</p>
            </div>
        </section>
        <section class="py-5 text-white">
            <div class="container text-center">
                <div class="row justify-content-center mb-4">
                    <div class="col-4 col-md-2">
                        <button class="btn btn-gradient btn-outline-dark w-100 py-3" onclick="showInfo('people')">
                            <i class="bi bi-people-fill fs-3"></i>
                            <div class="small mt-2 text-white">Kupuj</div>
                        </button>
                    </div>
                    <div class="col-4 col-md-2">
                        <button class="btn btn-gradient btn-outline-dark w-100 py-3" onclick="showInfo('calendar')">
                            <i class="bi bi-calendar-plus-fill fs-3"></i>
                            <div class="small mt-2 text-white">Wynajmuj</div>
                        </button>
                    </div>
                    <div class="col-4 col-md-2">
                        <button class="btn btn-gradient btn-outline-dark w-100 py-3" onclick="showInfo('car')">
                            <i class="bi bi-car-front-fill fs-3"></i>
                            <div class="small mt-2 text-white">Sprzedawaj</div>
                        </button>
                    </div>
                </div>

                <div class="info-section mt-4">
                    <div id="people" class="info-text active">
                        <h4>Znajdź swój wymarzony dom</h4>
                        <p>Dzięki inteligentnym filtrom wyszukiwania znajdziesz właściwą nieruchomość dostosowaną do
                            Twoich potrzeb i budżetu.
                        </p>
                    </div>
                    <div id="calendar" class="info-text d-none">
                        <h4>Wynajmuj z pewnością</h4>
                        <p>Poszukujesz miejsca do wynajęcia? Oferujemy starannie sprawdzone nieruchomości od zaufanych
                            właścicieli.</p>
                    </div>
                    <div id="car" class="info-text d-none">
                        <h4>Sprzedawaj skutecznie</h4>
                        <p>Zapewniamy kompleksową obsługę, dzięki naszemu doświadczeniu szybko znajdziesz odpowiedniego
                            nabywcę!</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        function showInfo(id) {
            const texts = document.querySelectorAll('.info-text');
            texts.forEach(text => text.classList.add('d-none'));
            document.getElementById(id).classList.remove('d-none');
        }
    </script>
</main>
@include('includes.footer')
</body>
</html>
