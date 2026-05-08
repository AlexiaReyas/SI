<?= view('partials/header', ['title' => 'Tableau de bord - NutriFit']) ?>

<div class="row mb-4">
    <div class="col-md-8">
        <h2 class="fw-bold">Bonjour, <?= esc($user['nom'] ?? 'Utilisateur') ?> !</h2>
        <p class="text-muted">Voici un aperçu de vos statistiques et objectifs.</p>
    </div>
    <div class="col-md-4 text-end">
        <div class="card card-custom d-inline-block px-4 py-2 text-center" style="min-width: 150px;">
            <p class="mb-0 text-muted small">Portefeuille</p>
            <h4 class="mb-0 text-gold"><?= esc($user['balance'] ?? '0.00') ?> Ar</h4>
        </div>
    </div>
</div>

<div class="row">
    <!-- IMC Card -->
    <div class="col-md-4 mb-4">
        <div class="card card-custom h-100 p-4 text-center">
            <h5 class="text-light mb-3">Votre IMC Actuel</h5>
            <div class="position-relative d-inline-block mx-auto mb-3" style="width: 150px; height: 150px;">
                <canvas id="imcChart"></canvas>
                <div class="position-absolute top-50 start-50 translate-middle text-center">
                    <h3 class="mb-0 fw-bold"><?= esc($user['imc'] ?? '0') ?></h3>
                </div>
            </div>
            <p class="mb-0 fw-bold" id="imcStatus">Calcul en cours...</p>
            <small class="text-muted">Poids: <?= esc($user['poids'] ?? '--') ?> kg | Taille: <?= esc($user['taille'] ?? '--') ?> cm</small>
        </div>
    </div>

    <!-- Objectif en cours -->
    <div class="col-md-4 mb-4">
        <div class="card card-custom h-100 p-4">
            <h5 class="text-light mb-4">Objectif Actuel</h5>
            <div class="text-center mb-4">
                <?php 
                    $objIcon = 'fa-bullseye text-gold';
                    $objLabel = 'Atteindre mon IMC idéal';
                    if(($user['objectif'] ?? '') === 'augmenter') { $objIcon = 'fa-arrow-trend-up text-success'; $objLabel = 'Augmenter mon poids'; }
                    if(($user['objectif'] ?? '') === 'reduire') { $objIcon = 'fa-arrow-trend-down text-danger'; $objLabel = 'Réduire mon poids'; }
                ?>
                <i class="fa-solid <?= $objIcon ?> fa-3x mb-3"></i>
                <h4><?= $objLabel ?></h4>
            </div>
            <div class="d-grid mt-auto">
                <a href="<?= base_url('recommendations') ?>" class="btn btn-outline-gold">Voir mes suggestions</a>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-md-4 mb-4">
        <div class="card card-custom h-100 p-4">
            <h5 class="text-light mb-3">Actions Rapides</h5>
            <div class="d-grid gap-3">
                <a href="<?= base_url('wallet') ?>" class="btn btn-dark text-start border-secondary">
                    <i class="fa-solid fa-wallet text-gold me-2"></i> Recharger mon portefeuille
                </a>
                <a href="<?= base_url('gold') ?>" class="btn btn-dark text-start border-secondary">
                    <i class="fa-solid fa-crown text-warning me-2"></i> Activer le mode Gold
                </a>
                <a href="<?= base_url('profile') ?>" class="btn btn-dark text-start border-secondary">
                    <i class="fa-solid fa-user-pen text-info me-2"></i> Modifier mes mensurations
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('imcChart').getContext('2d');
    const userImc = parseFloat('<?= esc($user['imc'] ?? '0') ?>');
    
    // Détermination de la couleur selon l'IMC (Simplifiée)
    let imcColor = '#D4AF37'; // Gold
    let imcText = 'Normal';
    
    if(userImc > 0) {
        if(userImc < 18.5) { imcColor = '#0dcaf0'; imcText = 'Insuffisance pondérale'; }
        else if(userImc < 25) { imcColor = '#198754'; imcText = 'Poids normal'; }
        else if(userImc < 30) { imcColor = '#ffc107'; imcText = 'Surpoids'; }
        else { imcColor = '#dc3545'; imcText = 'Obésité'; }
    } else {
        imcColor = '#444';
        imcText = 'Non défini';
    }

    document.getElementById('imcStatus').innerText = imcText;
    document.getElementById('imcStatus').style.color = imcColor;

    // Jauge circulaire (Doughnut) Chart.js
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Votre IMC', 'Reste'],
            datasets: [{
                data: [userImc, Math.max(0, 40 - userImc)], // On simule un max gauge à 40
                backgroundColor: [imcColor, '#2A2A2A'],
                borderWidth: 0,
                cutout: '80%'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { tooltip: { enabled: false }, legend: { display: false } },
            animation: { animateRotate: true }
        }
    });
});
</script>

<?= view('partials/footer') ?>
