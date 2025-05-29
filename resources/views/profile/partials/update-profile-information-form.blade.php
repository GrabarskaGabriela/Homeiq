<section class="mb-5">
    <header class="mb-4">
        <h2 class="h4 text-color_2">
            Aktualizacja danych osobowych
        </h2>
        <p class="text-color_2 small">
            Zaktualizuj informacje profilowe oraz adres e-mail swojego konta.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mb-3 text-color_2">
            <label for="first_name" class="form-label"> Imię</label>
            <input type="text" class="form-control" id="first_name" name="first_name"
                   value="{{ old('first_name', $user->first_name) }}" required autofocus autocomplete="first_name">
            @if ($errors->get('first_name'))
                <div class="text-danger small mt-1">
                    {{ $errors->first('first_name') }}
                </div>
            @endif
        </div>

        <div class="mb-3 text-color_2">
            <label for="last_name" class="form-label"> Nazwisko</label>
            <input type="text" class="form-control" id="last_name" name="last_name"
                   value="{{ old('last_name', $user->last_name) }}" required autofocus autocomplete="last_name">
            @if ($errors->get('last_name'))
                <div class="text-danger small mt-1">
                    {{ $errors->first('last_name') }}
                </div>
            @endif
        </div>

        <div class="mb-3 text-color_2">
            <label for="email" class="form-label"> Adres email</label>
            <input type="email" class="form-control" id="email" name="email"
                   value="{{ old('email', $user->email) }}" required autocomplete="username">
            @if ($errors->get('email'))
                <div class="text-danger small mt-1">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn-gradient text-color_2"> Zapisz
            </button>

            @if (session('status') === 'password-updated')
                <span class="text-success small">
                     Zapisano
                </span>
            @endif
        </div>
    </form>
</section>
