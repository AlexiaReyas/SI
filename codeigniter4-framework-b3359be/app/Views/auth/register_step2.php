<?= view('partials/header', ['title' => 'Inscription - Etape 2']) ?>
<div class="auth-shell">
    <div class="row g-4 align-items-stretch">
        <div class="col-lg-7">
            <div class="card auth-card p-4 p-lg-5">
                <h2 class="section-title mb-2">Inscription - Etape 2</h2>
                <p class="text-muted mb-4">Informations sante.</p>
                <form method="post" action="/register-step2">
                    <div class="mb-3">
                        <label class="form-label">Taille (cm)</label>
                        <input class="form-control" type="number" step="0.01" name="height_cm" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Poids (kg)</label>
                        <input class="form-control" type="number" step="0.01" name="weight_kg" required>
                    </div>
                    <button class="btn btn-brand" type="submit">Creer le compte</button>
                </form>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="auth-visual h-100">
                <div>
                    <span class="badge text-bg-light border mb-3">Etape 2/2</span>
                    <h3 class="mb-3">Finalisons votre profil.</h3>
                    <p class="text-muted mb-0">Votre IMC sera calcule automatiquement.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= view('partials/footer') ?>
