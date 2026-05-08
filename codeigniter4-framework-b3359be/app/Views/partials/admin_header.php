<?php
$title = $title ?? 'Admin';
$userName = session('user_name');
$path = trim((string) (parse_url(current_url(), PHP_URL_PATH) ?? ''));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body class="admin-shell">
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="/admin">Admin RegimeApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link <?= $path === '/admin' ? 'active' : '' ?>" href="/admin">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link <?= str_starts_with($path, '/admin/regimes') ? 'active' : '' ?>" href="/admin/regimes">Regimes</a></li>
                <li class="nav-item"><a class="nav-link <?= str_starts_with($path, '/admin/activities') ? 'active' : '' ?>" href="/admin/activities">Activites</a></li>
                <li class="nav-item"><a class="nav-link <?= str_starts_with($path, '/admin/codes') ? 'active' : '' ?>" href="/admin/codes">Codes</a></li>
                <li class="nav-item"><a class="nav-link <?= str_starts_with($path, '/admin/settings') ? 'active' : '' ?>" href="/admin/settings">Parametres</a></li>
            </ul>
            <?php if ($userName): ?>
                <span class="text-white small me-2">Admin <?= esc($userName) ?></span>
                <a class="btn btn-light btn-sm" href="/admin/logout">Deconnexion</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<main class="container py-4">
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
<?php endif; ?>
