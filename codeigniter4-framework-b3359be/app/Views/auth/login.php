<<<<<<< HEAD
<?= view('partials/header', ['title' => 'Connexion - NutriFit']) ?>

<div class="row justify-content-center align-items-center mt-5">
    <div class="col-md-5 col-lg-4">
        <div class="card card-custom p-4">
            <div class="text-center mb-4">
                <i class="fa-solid fa-leaf text-gold fa-3x mb-3"></i>
                <h2 class="fw-bold">Bon retour !</h2>
                <p class="text-muted">Connectez-vous pour voir vos objectifs</p>
            </div>

            <form action="<?= base_url('login') ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="mb-3">
                    <label for="email" class="form-label text-light">Adresse Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark text-gold border-secondary"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="email" required placeholder="nom@exemple.com">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label text-light">Mot de passe</label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark text-gold border-secondary"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" required placeholder="********">
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-gold btn-lg">Se connecter</button>
                </div>
            </form>

            <div class="text-center mt-4">
                <p class="text-muted mb-0">Pas encore de compte ? <a href="<?= base_url('register-step1') ?>" class="text-gold text-decoration-none">S'inscrire</a></p>
=======
<?= view('partials/header', ['title' => 'Connexion']) ?>
<div class="auth-shell">
    <div class="row g-4 align-items-stretch">
        <div class="col-lg-6">
            <div class="card auth-card p-4 p-lg-5">
                <h2 class="section-title mb-2">Connexion</h2>
                <p class="text-muted mb-4">Accedez a votre suivi nutritionnel.</p>
                <form method="post" action="/login">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input class="form-control" type="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input class="form-control" type="password" name="password" required>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <button class="btn btn-brand" type="submit">Se connecter</button>
                        <a class="small text-muted" href="#">Mot de passe oublie ?</a>
                    </div>
                </form>
                <p class="mt-4 mb-0">Pas de compte ? <a href="/register-step1">S'inscrire</a></p>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="auth-visual h-100">
                <div>
                    <span class="badge text-bg-light border mb-3">Bienvenue</span>
                    <h3 class="mb-3">Une experience claire et personnalisee.</h3>
                    <p class="text-muted mb-0">Retrouvez vos objectifs, vos recommandations et vos statistiques en un seul endroit.</p>
                </div>
>>>>>>> front
            </div>
        </div>
    </div>
</div>

<?= view('partials/footer') ?>
