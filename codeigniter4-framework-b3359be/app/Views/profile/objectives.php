<?= view('partials/header', ['title' => 'Objectifs']) ?>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card p-4">
            <h2 class="section-title mb-3">Choisir jusqu'a 3 objectifs</h2>
            <form method="post" action="/objectives">
                <?php $selected = $selected ?? []; ?>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="objectives[]" value="augmenter" id="obj1" <?= in_array('augmenter', $selected, true) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="obj1">Augmenter son poids</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="objectives[]" value="reduire" id="obj2" <?= in_array('reduire', $selected, true) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="obj2">Reduire son poids</label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="objectives[]" value="ideal" id="obj3" <?= in_array('ideal', $selected, true) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="obj3">Atteindre son IMC ideal</label>
                </div>
                <button class="btn btn-brand" type="submit">Enregistrer</button>
            </form>
        </div>
    </div>
</div>
<?= view('partials/footer') ?>
