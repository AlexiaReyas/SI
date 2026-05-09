<?= view('partials/header', ['title' => 'Inscription (2/2) - NutriFit']) ?>

<div class="row justify-content-center mt-4">
    <div class="col-md-6 col-lg-5">
        <div class="card card-custom p-4">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-gold">Profil Santé</h3>
                <p class="text-muted">Étape 2 sur 2 : Mensurations et Objectifs</p>
                <div class="progress" style="height: 5px; background-color: #333;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 100%;"></div>
                </div>
            </div>

            <form action="<?= base_url('register-step2') ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="taille" class="form-label text-light">Taille (cm)</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="taille" name="height_cm" required min="100" max="250" placeholder="Ex: 175">
                            <span class="input-group-text bg-dark text-muted border-secondary">cm</span>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="poids" class="form-label text-light">Poids (kg)</label>
                        <div class="input-group">
                            <input type="number" step="0.1" class="form-control" id="poids" name="weight_kg" required min="30" max="300" placeholder="Ex: 70">
                            <span class="input-group-text bg-dark text-muted border-secondary">kg</span>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-light d-block mb-3">Quel est votre objectif principal ?</label>
                    
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="objectif" id="obj1" value="augmenter" required>
                        <label class="form-check-label text-light" for="obj1">
                            <i class="fa-solid fa-arrow-trend-up text-success me-2"></i> Augmenter mon poids
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="objectif" id="obj2" value="reduire" required>
                        <label class="form-check-label text-light" for="obj2">
                            <i class="fa-solid fa-arrow-trend-down text-danger me-2"></i> Réduire mon poids
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="objectif" id="obj3" value="ideal" required>
                        <label class="form-check-label text-light" for="obj3">
                            <i class="fa-solid fa-bullseye text-gold me-2"></i> Atteindre mon IMC idéal
                        </label>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('register-step1') ?>" class="btn btn-outline-secondary">Retour</a>
                    <button type="submit" class="btn btn-gold px-4">Terminer l'inscription</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= view('partials/footer') ?>
