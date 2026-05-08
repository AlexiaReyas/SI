<?= view('partials/header', ['title' => 'Porte-monnaie']) ?>
<div class="row g-4">
    <div class="col-lg-5">
        <div class="card p-4">
            <h2 class="section-title">Mon porte-monnaie</h2>
            <p class="text-muted mb-1">Solde actuel</p>
            <p class="display-6 mb-0"><?= number_format((float) ($user['wallet'] ?? 0), 2) ?> Ar</p>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card p-4">
            <h3 class="section-title mb-3">Ajouter de l'argent via code</h3>
            <form method="post" action="/wallet">
                <div class="mb-3">
                    <label class="form-label">Code</label>
                    <input class="form-control" type="text" name="code" required>
                </div>
                <button class="btn btn-brand" type="submit">Valider</button>
            </form>
        </div>
    </div>
</div>
<?= view('partials/footer') ?>
