<?= view('partials/admin_header', ['title' => 'Codes']) ?>
<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="section-title mb-0">Codes de recharge</h2>
        <a class="btn btn-brand" href="/admin/codes/create">Ajouter un code</a>
    </div>
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Montant</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($codes as $code): ?>
                <tr>
                    <td><?= esc($code['code']) ?></td>
                    <td><?= number_format($code['amount'], 2) ?> Ar</td>
                    <td><?= (int) $code['is_valid'] === 1 ? 'Valide' : 'Invalide' ?></td>
                    <td>
                        <form method="post" action="/admin/codes/<?= $code['id'] ?>/toggle">
                            <button class="btn btn-outline-secondary btn-sm" type="submit">Basculer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= view('partials/admin_footer') ?>
