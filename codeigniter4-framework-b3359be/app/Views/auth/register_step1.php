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
        </div>
    </div>
</div>
<?= view('partials/footer') ?>
