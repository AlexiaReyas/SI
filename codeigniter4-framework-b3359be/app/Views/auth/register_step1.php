<?= view('partials/header', ['title' => 'Inscription - Etape 1']) ?>
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card p-4">
            <h2 class="section-title mb-3">Inscription - Informations personnelles</h2>
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
</div>
<?= view('partials/footer') ?>
