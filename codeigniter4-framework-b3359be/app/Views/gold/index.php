<?= view('partials/header', ['title' => 'Mode Gold - NutriFit']) ?>

<div class="row justify-content-center text-center mb-5">
    <div class="col-md-8">
        <i class="fa-solid fa-crown text-warning fa-4x mb-3"></i>
        <h1 class="fw-bold text-gold">Devenez Membre Gold</h1>
        <p class="text-muted fs-5">Débloquez des avantages exclusifs pour atteindre vos objectifs plus vite.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card card-custom p-0 overflow-hidden" style="border: 2px solid var(--gold-primary);">
            <div class="bg-dark text-center py-4 border-bottom border-secondary">
                <h3 class="text-light mb-0">Forfait Unique</h3>
                <h2 class="text-gold fw-bold mt-2 mb-0">15 000 <span class="fs-5">Ar</span></h2>
                <span class="badge bg-warning text-dark mt-2">Paiement unique (À vie)</span>
            </div>
            
            <div class="p-4">
                <ul class="list-unstyled mb-4">
                    <li class="mb-3 text-light"><i class="fa-solid fa-check text-success me-2"></i> <strong>15% de remise</strong> sur tous les régimes.</li>
                    <li class="mb-3 text-light"><i class="fa-solid fa-check text-success me-2"></i> Accès prioritaire aux nouvelles activités.</li>
                    <li class="mb-3 text-light"><i class="fa-solid fa-check text-success me-2"></i> Historique détaillé de vos variations d'IMC.</li>
                    <li class="mb-3 text-light"><i class="fa-solid fa-check text-success me-2"></i> Sans publicité.</li>
                </ul>

                <?php if(($user['is_gold'] ?? false)): ?>
                    <div class="alert alert-success text-center mb-0">
                        <i class="fa-solid fa-crown me-2"></i> <strong>Vous êtes déjà membre Gold !</strong>
                    </div>
                <?php else: ?>
                    <form action="<?= base_url('gold') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="d-grid">
                            <?php if(($user['balance'] ?? 0) >= 15000): ?>
                                <button type="submit" class="btn btn-gold btn-lg fw-bold">Acheter l'Option Gold</button>
                            <?php else: ?>
                                <button type="button" class="btn btn-secondary btn-lg" disabled>Solde insuffisant (<?= esc($user['balance'] ?? '0') ?> Ar)</button>
                                <a href="<?= base_url('wallet') ?>" class="text-gold text-center d-block mt-3 text-decoration-none">Recharger mon portefeuille</a>
                            <?php endif; ?>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= view('partials/footer') ?>
