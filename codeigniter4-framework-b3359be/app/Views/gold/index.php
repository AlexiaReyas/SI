<?= view('partials/header', ['title' => 'Option Gold']) ?>
<div class="row g-4">
    <div class="col-lg-7">
        <div class="card p-4">
            <h2 class="section-title">Option Gold</h2>
            <p class="text-muted">Prix unique: <strong><?= number_format($price, 2) ?> Ar</strong></p>
            <p>Remise: 15% sur tous les regimes</p>
            <p>Statut actuel: <?= (int) ($user['gold'] ?? 0) === 1 ? 'Activee' : 'Non activee' ?></p>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card p-4">
            <h3 class="section-title mb-3">Activer</h3>
            <form method="post" action="/gold">
                <button class="btn btn-brand" type="submit">Activer l'option Gold</button>
            </form>
        </div>
    </div>
</div>
<?= view('partials/footer') ?>
