<?= view('partials/admin_header', ['title' => 'Admin - Connexion']) ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card p-4">
            <h2 class="section-title mb-3">Connexion Admin</h2>
            <form method="post" action="/admin/login">
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
        </div>
    </div>
</div>
<?= view('partials/admin_footer') ?>
