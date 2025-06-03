<div class="col-md-3">
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-cogs me-2"></i>Menu</h5>
        </div>
        <div class="list-group list-group-flush">
            <a href="{{ route('admin.users') }}" class="list-group-item list-group-item-action">
                <i class="fas fa-tachometer-alt me-2"></i>Użytkownicy
            </a>
            <a href="{{ route('admin.transactions') }}" class="list-group-item list-group-item-action">
                <i class="fas fa-users me-2"></i>Transakcje
            </a>
            <a href="{{ route('admin.offers') }}" class="list-group-item list-group-item-action">
                <i class="fas fa-flag me-2"></i>Oferty
            </a>
        </div>
    </div>
</div>
