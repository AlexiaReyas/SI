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
            </div>
        </div>
    </div>
</div>
<?= view('partials/footer') ?>
