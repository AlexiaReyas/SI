<?= view('partials/admin_header', ['title' => 'Modifier une activite']) ?>
<div class="card p-4">
    <h2 class="section-title mb-3">Modifier activite</h2>
    <form method="post" action="/admin/activities/<?= $activity['id'] ?>">
        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input class="form-control" type="text" name="name" value="<?= esc($activity['name']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" required><?= esc($activity['description']) ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Duree (minutes)</label>
            <input class="form-control" type="number" name="duration_minutes" value="<?= esc($activity['duration_minutes']) ?>" required>
        </div>
        <button class="btn btn-brand" type="submit">Mettre a jour</button>
    </form>
</div>
<?= view('partials/admin_footer') ?>
