<?= view('partials/header', ['title' => 'Connexion']) ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card p-4">
            <h2 class="section-title mb-3">Connexion</h2>
            <form method="post" action="/login">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input class="form-control" type="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <input class="form-control" type="password" name="password" required>
                </div>
                <button class="btn btn-brand" type="submit">Se connecter</button>
            </form>
            <p class="mt-3">Pas de compte ? <a href="/register-step1">S'inscrire</a></p>
        </div>
    </div>
</div>
<?= view('partials/footer') ?>
