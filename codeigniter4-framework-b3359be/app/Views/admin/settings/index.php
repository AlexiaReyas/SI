<?= view('partials/admin_header', ['title' => 'Parametres']) ?>
<div class="card p-4">
    <h2 class="section-title mb-3">Parametres</h2>
    <form method="post" action="/admin/settings">
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">IMC minimum normal</label>
                <input class="form-control" type="number" step="0.01" name="imc_min_normal" value="<?= esc($settings['imc_min_normal'] ?? '') ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">IMC maximum normal</label>
                <input class="form-control" type="number" step="0.01" name="imc_max_normal" value="<?= esc($settings['imc_max_normal'] ?? '') ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Prix option Gold</label>
                <input class="form-control" type="number" step="0.01" name="gold_price" value="<?= esc($settings['gold_price'] ?? '') ?>">
            </div>
        </div>
        <button class="btn btn-brand" type="submit">Mettre a jour</button>
    </form>
</div>
<?= view('partials/admin_footer') ?>
