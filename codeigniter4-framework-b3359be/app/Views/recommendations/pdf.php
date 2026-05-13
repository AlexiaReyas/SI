<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Recommandations - NutriFit</title>
    <style>
        body { font-family: Arial, sans-serif; color: #111; }
        h1 { font-size: 20px; margin-bottom: 8px; }
        h2 { font-size: 16px; margin-top: 16px; }
        p { margin: 4px 0; }
        .box { border: 1px solid #ddd; padding: 10px; margin-top: 8px; }
        .muted { color: #555; }
        .price { margin-top: 12px; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Vos recommandations NutriFit</h1>
    <p class="muted">IMC: <strong><?= esc($imc ?? '--') ?></strong> | Objectif: <strong><?= esc($goal ?? 'Non defini') ?></strong></p>

    <h2>Regime conseille</h2>
    <?php if (empty($regime)): ?>
        <p>Aucun regime disponible.</p>
    <?php else: ?>
        <div class="box">
            <p><strong><?= esc($regime['name'] ?? '') ?></strong></p>
            <p class="muted"><?= esc($regime['description'] ?? '') ?></p>
            <p>Viande: <?= esc($regime['pct_meat'] ?? 0) ?>% | Poisson: <?= esc($regime['pct_fish'] ?? 0) ?>% | Volaille: <?= esc($regime['pct_poultry'] ?? 0) ?>%</p>
        </div>
    <?php endif; ?>

    <h2>Activite conseillee</h2>
    <?php if (empty($activity)): ?>
        <p>Aucune activite disponible.</p>
    <?php else: ?>
        <div class="box">
            <p><strong><?= esc($activity['name'] ?? '') ?></strong></p>
            <p class="muted"><?= esc($activity['description'] ?? '') ?></p>
        </div>
    <?php endif; ?>

    <div class="price">
        Prix: <?= esc(number_format((float) ($price ?? 0), 2)) ?> | Remise: <?= esc(number_format((float) ($discount ?? 0), 2)) ?> | Total: <?= esc(number_format((float) ($finalPrice ?? 0), 2)) ?>
    </div>
</body>
</html>
