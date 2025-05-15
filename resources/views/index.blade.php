<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('messages.title.faily') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="text-white">
<main>
    <div class="page-container">
        @include('includes.navbar')

        <section class="hero py-5 text-color text-center">
            <div class="container">
                <h1 class="display-4 fw-bold mb-4">Tysiące chomiczych norek na wyciągnięcie łapki.</h1>
                <p class="lead mb-4">Na sprzedaż i na wynajem</p>
            </div>
        </section>
        <section class="py-5 text-white" style="background-color: #404040;">
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
                        <h4>Kupuj</h4>
                        <p>Tu będzie opis</p>
                    </div>
                    <div id="calendar" class="info-text d-none">
                        <h4>Wynajmuj</h4>
                        <p>Tu będzie opis</p>
                    </div>
                    <div id="car" class="info-text d-none">
                        <h4>Sprzedawaj</h4>
                        <p>Tu będzie opis</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 bg-transparent">
            <div class="container">
                <h2 class="text-center mb-5">Zerknij jak to śmiga</h2>
                <div class="row justify-content-center g-4">
                    <div class="col-10 col-sm-6 col-md-4 d-flex justify-content-center">
                        <img src="{{ asset('images/includes/zdjecie3.png') }}" class="img-fluid rounded shadow" alt="Wydarzenie 1">
                    </div>
                    <div class="col-10 col-sm-6 col-md-4 d-flex justify-content-center">
                        <img src="{{ asset('images/includes/zdjecie2.png') }}" class="img-fluid rounded shadow" alt="Wydarzenie 2">
                    </div>
                    <div class="col-10 col-sm-6 col-md-4 d-flex justify-content-center">
                        <img src="{{ asset('images/includes/zdjecie3.png') }}" class="img-fluid rounded shadow" alt="Wydarzenie 3">
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
