<?= view('partials/admin_header', ['title' => 'Regimes']) ?>
<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="section-title mb-0">Regimes</h2>
        <a class="btn btn-brand" href="/admin/regimes/create">Ajouter un regime</a>
    </div>
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Duree</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($regimes as $regime): ?>
                <tr>
                    <td><?= esc($regime['name']) ?></td>
                    <td><?= number_format($regime['base_price'], 2) ?> Ar</td>
                    <td><?= esc($regime['duration_days']) ?> j</td>
                    <td class="d-flex gap-2">
                        <a class="btn btn-outline-secondary btn-sm" href="/admin/regimes/<?= $regime['id'] ?>/edit">Modifier</a>
                        <form method="post" action="/admin/regimes/<?= $regime['id'] ?>/delete">
                            <button class="btn btn-outline-danger btn-sm" type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= view('partials/admin_footer') ?>
