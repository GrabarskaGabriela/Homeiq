<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wystaw ofertę - Homeiq</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .center-column {
            display: flex;
            flex-direction: column;
        }

        .center-column > .card {
            flex: 1;
        }
    </style>

    {{-- NIE UMIESZCZAJ @include W <head> --}}
</head>
<body>
{{-- To powinno być tutaj --}}
@include('includes.navbar')

<main class="container my-5">
    <h2 class="mb-4">Wystaw ofertę nieruchomości</h2>
    <form method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row align-items-stretch">
            {{-- Lokalizacja --}}
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Lokalizacja</h5>
                        @foreach (['country'=>'Państwo', 'region'=>'Region', 'city'=>'Miasto', 'street'=>'Ulica', 'number'=>'Numer domu/mieszkania'] as $id => $label)
                            <div class="mb-3">
                                <label for="{{ $id }}" class="form-label">{{ $label }}</label>
                                <input type="text" class="form-control" id="{{ $id }}" name="{{ $id }}" placeholder="Wpisz {{ strtolower($label) }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Opis + zdjęcia --}}
            <div class="col-md-4 center-column">
                <div class="card mb-2 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Opis nieruchomości</h5>
                        <div class="mb-3">
                            <label for="description" class="form-label">Opis</label>
                            <textarea class="form-control" id="description" name="description" rows="5" placeholder="Opisz nieruchomość"></textarea>
                        </div>
                    </div>
                </div>

                <div class="card mt-2 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Dodaj zdjęcia</h5>
                        <div class="mb-3">
                            <label for="images" class="form-label">Wybierz zdjęcia</label>
                            <input class="form-control" type="file" id="images" name="images[]" multiple>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Dane techniczne --}}
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Dane techniczne</h5>

                        {{-- Cena --}}
                        <div class="mb-3">
                            <label for="price" class="form-label">Cena (PLN)</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Wpisz cenę">
                        </div>

                        {{-- Powierzchnia --}}
                        <div class="mb-3">
                            <label for="area" class="form-label">Powierzchnia</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="area" name="area" placeholder="Powierzchnia">
                                <span class="input-group-text">m²</span>
                            </div>
                        </div>

                        {{-- Selecty --}}
                        @php
                            $selects = [
                                'Typ nieruchomości' => ['mieszkanie'=>'Mieszkanie', 'dom'=>'Dom'],
                                'Liczba pokoi' => ['1','2','3','4','5','6','7','8','9','10'],
                                'Konstrukcja' => ['blok'=>'Blok', 'blizniak'=>'Bliźniak', 'szeregowiec'=>'Szeregowiec'],
                                'Wyposażenie' => ['brak'=>'Brak', 'czesciowo'=>'Częściowo umeblowane', 'umeblowane'=>'Umeblowane'],
                                'Stan nieruchomości' => ['do_remontu'=>'Do remontu', 'do_zamieszkania'=>'Do zamieszkania', 'surowy'=>'Stan surowy'],
                            ];
                        @endphp

                        @foreach ($selects as $id => $options)
                            <div class="mb-3">
                                <label for="{{ $id }}" class="form-label">{{ ucfirst(str_replace('_', ' ', $id)) }}</label>
                                <select class="form-select" id="{{ $id }}" name="{{ $id }}">
                                    @foreach ($options as $val => $label)
                                        <option value="{{ is_string($val) ? $val : $label }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

        <div class="mb-5 mt-4">
            <button type="submit" class="btn btn-primary">Wystaw ofertę</button>
        </div>
    </form>
</main>

@include('includes.footer')
</body>
</html>
