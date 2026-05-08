<?= view('partials/admin_header', ['title' => 'Ajouter un regime']) ?>
<div class="card p-4">
    <h2 class="section-title mb-3">Nouveau regime</h2>
    <form method="post" action="/admin/regimes">
        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input class="form-control" type="text" name="name" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" required></textarea>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Prix</label>
                <input class="form-control" type="number" step="0.01" name="base_price" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Duree (jours)</label>
                <input class="form-control" type="number" name="duration_days" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Variation poids (kg)</label>
                <input class="form-control" type="number" step="0.01" name="weight_change_kg" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">% Viande</label>
                <input class="form-control" type="number" name="pct_meat" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">% Poisson</label>
                <input class="form-control" type="number" name="pct_fish" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">% Volaille</label>
                <input class="form-control" type="number" name="pct_poultry" required>
            </div>
        </div>
        <button class="btn btn-brand" type="submit">Enregistrer</button>
    </form>
</div>
<?= view('partials/admin_footer') ?>
