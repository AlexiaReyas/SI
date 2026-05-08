<?= view('partials/header', ['title' => 'Recommandations']) ?>
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card p-4">
            <h2 class="section-title">Resultats</h2>
            <p class="text-muted mb-1">IMC</p>
            <p class="display-6 mb-3"><?= esc($imc) ?></p>
            <p>Objectif deduit: <span class="badge badge-goal"><?= esc($goal) ?></span></p>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card p-4">
            <h3 class="section-title mb-3">Regime recommande</h3>
            <?php if ($regime): ?>
                <p class="h5 mb-1"><?= esc($regime['name']) ?></p>
                <p class="text-muted"><?= esc($regime['description']) ?></p>
                <div class="row">
                    <div class="col-md-6">
                        <p>Duree: <?= esc($regime['duration_days']) ?> jours</p>
                        <p>Variation poids: <?= esc($regime['weight_change_kg']) ?> kg</p>
                    </div>
                    <div class="col-md-6">
                        <p>Viande <?= esc($regime['pct_meat']) ?>% | Poisson <?= esc($regime['pct_fish']) ?>% | Volaille <?= esc($regime['pct_poultry']) ?>%</p>
                        <p>Prix: <?= number_format($price, 2) ?> Ar</p>
                        <?php if ($discount > 0): ?>
                            <p>Remise Gold: -<?= number_format($discount, 2) ?> Ar</p>
                        <?php endif; ?>
                        <p class="fw-bold">Total: <?= number_format($finalPrice, 2) ?> Ar</p>
                    </div>
                </div>
            <?php else: ?>
                <p>Aucun regime disponible.</p>
            <?php endif; ?>
        </div>
        <div class="card p-4 mt-4">
            <h3 class="section-title">Activite sportive</h3>
            <?php if ($activity): ?>
                <p class="h5 mb-1"><?= esc($activity['name']) ?></p>
                <p class="text-muted"><?= esc($activity['description']) ?></p>
                <p>Duree: <?= esc($activity['duration_minutes']) ?> minutes</p>
            <?php else: ?>
                <p>Aucune activite disponible.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= view('partials/footer') ?>
