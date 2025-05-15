<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('messages.title.myEvents') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-main">

@include('includes.navbar')

<main class="container mt-5 mb-5">
    <h1 class="fw-bold mb-4 text-color">{{ __('messages.myevents.myEvents') }}</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        @forelse ($offers as $offer)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm text-color">
                    <a href="{{ route('events.show', $offer->id) }}">
                        @if(isset($offer->photos) && count($offer->photos) > 0)
                            <img src="{{ asset('storage/' . $offer->photos[0]->path) }}"
                                 alt="{{ $offer->title }}"
                                 class="card-img-top"
                                 style="height: 250px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/includes/brak_zdjecia.jpg') }}"
                                 alt="Brak zdjęcia"
                                 class="card-img-top w-100"
                                 style="height: 250px; object-fit: cover;">
                        @endif
                    </a>
                    <div class="card-body">
                        <p class="text-truncate">{{ Str::limit($offer->description, 1000) }}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('offers.show', $event->id) }}"  class="btn">Zobacz</a>
                        <a href="{{ route('offers.edit', $event->id) }}" class="btn">Edytuj ogłoszenie</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    Brak własnych ogłoszeń.
                </div>
            </div>
        @endforelse
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $events->links('pagination::bootstrap-5') }}
    </div>
</main>
</div>
@include('includes.footer')
</body>
</html>
