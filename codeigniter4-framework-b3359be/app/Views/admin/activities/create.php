<?= view('partials/admin_header', ['title' => 'Ajouter une activite']) ?>
<div class="card p-4">
    <h2 class="section-title mb-3">Nouvelle activite</h2>
    <form method="post" action="/admin/activities">
        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input class="form-control" type="text" name="name" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Duree (minutes)</label>
            <input class="form-control" type="number" name="duration_minutes" required>
        </div>
        <button class="btn btn-brand" type="submit">Enregistrer</button>
    </form>
</div>
<?= view('partials/admin_footer') ?>
