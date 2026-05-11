<<<<<<< HEAD
<?= view('partials/header', ['title' => 'Inscription (1/2) - NutriFit']) ?>

<div class="row justify-content-center mt-4">
    <div class="col-md-6 col-lg-5">
        <div class="card card-custom p-4">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-gold">Créer un compte</h3>
                <p class="text-muted">Étape 1 sur 2 : Informations personnelles</p>
                <div class="progress" style="height: 5px; background-color: #333;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 50%;"></div>
                </div>
            </div>

            <form action="<?= base_url('register-step1') ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="mb-3">
                    <label for="nom" class="form-label text-light">Nom complet</label>
                    <input type="text" class="form-control" id="nom" name="name" required placeholder="Ex: Jean Dupont">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label text-light">Adresse Email</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="nom@exemple.com">
                </div>
                
                <div class="mb-3">
                    <label for="genre" class="form-label text-light">Genre</label>
                    <select class="form-select" id="genre" name="gender" required>
                        <option value="" disabled selected>Choisissez votre genre...</option>
                        <option value="M">Homme</option>
                        <option value="F">Femme</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label text-light">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required minlength="6" placeholder="Minimum 6 caractères">
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-gold btn-lg">Suivant <i class="fa-solid fa-arrow-right ms-2"></i></button>
                </div>
            </form>
            
            <div class="text-center mt-3">
                <small class="text-muted">Déjà inscrit ? <a href="<?= base_url('login') ?>" class="text-gold text-decoration-none">Connectez-vous</a></small>
            </div>
=======
<?= view('partials/header', ['title' => 'Inscription - Etape 1']) ?>
<div class="auth-shell">
    <div class="row g-4 align-items-stretch">
        <div class="col-lg-7">
            <div class="card auth-card p-4 p-lg-5">
                <h2 class="section-title mb-2">Inscription - Etape 1</h2>
                <p class="text-muted mb-4">Informations personnelles.</p>
                <form method="post" action="/register-step1">
                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input class="form-control" type="text" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input class="form-control" type="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input class="form-control" type="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Genre</label>
                        <select class="form-select" name="gender" required>
                            <option value="">Choisir</option>
                            <option value="M">Masculin</option>
                            <option value="F">Feminin</option>
                        </select>
                    </div>
                    <button class="btn btn-brand" type="submit">Suivant</button>
                </form>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="auth-visual h-100">
                <div>
                    <span class="badge text-bg-light border mb-3">Etape 1/2</span>
                    <h3 class="mb-3">Construisons votre profil.</h3>
                    <p class="text-muted mb-0">Ces informations nous aident a personnaliser votre experience.</p>
                </div>
            </div>
>>>>>>> front
        </div>
    </div>
</div>

<?= view('partials/footer') ?>
