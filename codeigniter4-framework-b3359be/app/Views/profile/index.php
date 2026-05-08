<?= view('partials/header', ['title' => 'Mon profil']) ?>
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card p-4">
            <h2 class="section-title mb-3">Profil utilisateur</h2>
            <form method="post" action="/profile">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nom</label>
                        <input class="form-control" type="text" name="name" value="<?= esc($user['name'] ?? '') ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Genre</label>
                        <select class="form-select" name="gender" required>
                            <option value="M" <?= ($user['gender'] ?? '') === 'M' ? 'selected' : '' ?>>Masculin</option>
                            <option value="F" <?= ($user['gender'] ?? '') === 'F' ? 'selected' : '' ?>>Feminin</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Taille (cm)</label>
                        <input class="form-control" type="number" step="0.01" name="height_cm" value="<?= esc($health['height_cm'] ?? '') ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Poids (kg)</label>
                        <input class="form-control" type="number" step="0.01" name="weight_kg" value="<?= esc($health['weight_kg'] ?? '') ?>" required>
                    </div>
                </div>
                <button class="btn btn-brand" type="submit">Mettre a jour</button>
            </form>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card p-4">
            <h3 class="section-title">IMC actuel</h3>
            <p class="display-6 mb-0"><?= isset($health['imc']) ? esc($health['imc']) : 'Non calcule' ?></p>
        </div>
    </div>
</div>
<?= view('partials/footer') ?>
