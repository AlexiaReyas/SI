<?= view('partials/admin_header', ['title' => 'Dashboard']) ?>
<div class="card p-4">
    <h2 class="section-title mb-3">Statistiques</h2>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card p-3">
                <p class="text-muted mb-1">Utilisateurs</p>
                <p class="h3 mb-0"><?= esc($userCount) ?></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3">
                <p class="text-muted mb-1">Regimes</p>
                <p class="h3 mb-0"><?= esc($regimeCount) ?></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3">
                <p class="text-muted mb-1">Activites</p>
                <p class="h3 mb-0"><?= esc($activityCount) ?></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3">
                <p class="text-muted mb-1">Codes valides</p>
                <p class="h3 mb-0"><?= esc($validCodes) ?></p>
            </div>
        </div>
        <div class="col-12">
            <div class="card p-3">
                <p class="text-muted mb-1">Total wallet</p>
                <p class="h3 mb-0"><?= number_format($walletTotal, 2) ?> Ar</p>
            </div>
        </div>
    </div>
</div>
<?= view('partials/admin_footer') ?>
