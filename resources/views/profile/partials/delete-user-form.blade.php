<section class="mb-5" >
    <header class="mb-4" >
        <h2 class="h4 text-color" >
            Usuń konto
        </h2>

        <p class="text-color small mt-2">
            Jakieś ostrzeżenie
        </p>
    </header>
    <div class="d-flex align-items-center gap-3">
        <button type="submit" class="btn-gradient-danger text-color" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">Usuń konto
        </button>
    </div>

    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionLabel" aria-hidden="true" >
        <div class="modal-dialog">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmUserDeletionLabel">
                            Potwierdź usunięcie konta
                        </h5>
                        <button type="button" class="btn-close white-close" data-bs-dismiss="modal" aria-label="Zamknij"></button>
                    </div>

                    <div class="modal-body">
                        <p class="text-color small">
                            Finalne definitywne ostateczne ostrzeżenie
                        </p>

                        <div class="mb-3">
                            <label for="password" class="form-label visually-hidden"> Wprowadź hasło do konta</label>
                            <input type="password"
                                   name="password"
                                   id="password"
                                   class="form-control"
                                   placeholder="Hasło"
                                   required>
                            @if ($errors->userDeletion->get('password'))
                                <div class="text-danger small mt-1">
                                    {{ $errors->userDeletion->first('password') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="d-flex align-items-center gap-3">
                            <button type="submit" class="btn-gradient-secondary text-color" data-bs-toggle="modal"> Anuluj
                            </button>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <button type="submit" class="btn-gradient-danger text-color" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">Usuń konto
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
