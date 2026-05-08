<?= view('partials/header', ['title' => 'Mon Profil - NutriFit']) ?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card card-custom p-4">
            <h3 class="fw-bold text-gold mb-4"><i class="fa-solid fa-user-pen me-2"></i>Mon Profil & Objectifs</h3>
            
            <form action="<?= base_url('profile') ?>" method="post">
                <?= csrf_field() ?>
                
                <h5 class="text-light mb-3">Informations Personnelles</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-light">Nom complet</label>
                        <input type="text" class="form-control" name="nom" value="<?= esc($user['nom'] ?? '') ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-light">Email</label>
                        <input type="email" class="form-control" value="<?= esc($user['email'] ?? '') ?>" disabled>
                        <small class="text-muted">L'email ne peut être modifié.</small>
                    </div>
                </div>

                <h5 class="text-light mb-3 mt-4">Mensurations</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-light">Taille (cm)</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="taille" value="<?= esc($user['taille'] ?? '') ?>" required min="100" max="250">
                            <span class="input-group-text bg-dark text-muted border-secondary">cm</span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-light">Poids (kg)</label>
                        <div class="input-group">
                            <input type="number" step="0.1" class="form-control" name="poids" value="<?= esc($user['poids'] ?? '') ?>" required min="30" max="300">
                            <span class="input-group-text bg-dark text-muted border-secondary">kg</span>
                        </div>
                    </div>
                </div>

                <h5 class="text-light mb-3 mt-4">Statut de l'Objectif</h5>
                <div class="mb-4">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="objectif" id="obj1" value="augmenter" <?= (($user['objectif'] ?? '') == 'augmenter') ? 'checked' : '' ?>>
                        <label class="form-check-label text-light" for="obj1">
                            <i class="fa-solid fa-arrow-trend-up text-success me-2"></i> Augmenter mon poids
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="objectif" id="obj2" value="reduire" <?= (($user['objectif'] ?? '') == 'reduire') ? 'checked' : '' ?>>
                        <label class="form-check-label text-light" for="obj2">
                            <i class="fa-solid fa-arrow-trend-down text-danger me-2"></i> Réduire mon poids
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="objectif" id="obj3" value="ideal" <?= (($user['objectif'] ?? '') == 'ideal') ? 'checked' : '' ?>>
                        <label class="form-check-label text-light" for="obj3">
                            <i class="fa-solid fa-bullseye text-gold me-2"></i> Atteindre mon IMC idéal
                        </label>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-gold"><i class="fa-solid fa-save me-2"></i>Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= view('partials/footer') ?>
