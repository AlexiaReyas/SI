<?= view('partials/header', ['title' => 'Inscription - Etape 2']) ?>
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card p-4">
            <h2 class="section-title mb-3">Inscription - Informations sante</h2>
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
</div>
<?= view('partials/footer') ?>
