<?= view('partials/admin_header', ['title' => 'Ajouter un code']) ?>
<div class="card p-4">
    <h2 class="section-title mb-3">Nouveau code</h2>
    <form method="post" action="/admin/codes">
        <div class="mb-3">
            <label class="form-label">Code</label>
            <input class="form-control" type="text" name="code" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Montant</label>
            <input class="form-control" type="number" step="0.01" name="amount" required>
        </div>
        <button class="btn btn-brand" type="submit">Enregistrer</button>
    </form>
</div>
<?= view('partials/admin_footer') ?>
