<?= view('partials/header', ['title' => 'Mes Suggestions - NutriFit']) ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-gold"><i class="fa-solid fa-clipboard-list me-2"></i>Vos Suggestions</h2>
    <!-- Bouton d'export PDF en haut à droite -->
    <a href="<?= base_url('recommendations/export_pdf') ?>" target="_blank" class="btn btn-outline-danger">
        <i class="fa-solid fa-file-pdf me-2"></i>Exporter en PDF
    </a>
</div>

<p class="text-muted mb-4">Basé sur votre IMC de <strong><?= esc($user['imc'] ?? '--') ?></strong> et votre objectif (<strong><?= esc($user['objectif_label'] ?? 'Non défini') ?></strong>).</p>

<div class="row">
    <!-- Colonne Régime -->
    <div class="col-md-6 mb-4">
        <div class="card card-custom h-100 p-4 border-success">
            <div class="text-center mb-3">
                <i class="fa-solid fa-utensils fa-3x text-success mb-2"></i>
                <h4 class="fw-bold text-success">Régime Alimentaire</h4>
            </div>
            <?php if(empty($regimes)): ?>
                <p class="text-center text-muted">Aucun régime suggéré pour le moment.</p>
            <?php else: ?>
                <?php foreach ($regimes as $regime): ?>
                <div class="bg-dark p-3 rounded mb-3 border border-secondary">
                    <h5 class="text-light"><?= esc($regime['nom']) ?></h5>
                    <p class="small text-muted mb-2"><?= esc($regime['description']) ?></p>
                    <div class="d-flex justify-content-between small">
                        <span class="badge bg-success"><i class="fa-solid fa-carrot me-1"></i>Viande: <?= esc($regime['viande_pct']) ?>%</span>
                        <span class="badge bg-info"><i class="fa-solid fa-fish me-1"></i>Poisson: <?= esc($regime['poisson_pct']) ?>%</span>
                        <span class="badge bg-warning text-dark"><i class="fa-solid fa-drumstick-bite me-1"></i>Volaille: <?= esc($regime['volaille_pct']) ?>%</span>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Colonne Activité (Correction de l'icône et titre) -->
    <div class="col-md-6 mb-4">
        <div class="card card-custom h-100 p-4 border-primary">
            <div class="text-center mb-3">
                <i class="fa-solid fa-person-running fa-3x text-primary mb-2"></i>
                <h4 class="fw-bold text-primary">Activité Sportive</h4>
            </div>
            <?php if(empty($activites)): ?>
                <p class="text-center text-muted">Aucune activité suggérée pour le moment.</p>
            <?php else: ?>
                <?php foreach ($activites as $activite): ?>
                <div class="bg-dark p-3 rounded mb-3 border border-secondary">
                    <h5 class="text-light"><?= esc($activite['nom']) ?></h5>
                    <p class="small text-muted mb-2"><?= esc($activite['description']) ?></p>
                    <span class="badge bg-primary"><i class="fa-solid fa-fire me-1"></i>Durée: <?= esc($activite['duration_minutes']) ?> min</span>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= view('partials/footer') ?>
