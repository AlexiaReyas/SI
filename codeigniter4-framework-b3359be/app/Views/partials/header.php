<?php
$title = $title ?? 'Regime App';
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
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/">RegimeApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link <?= $path === '/' ? 'active' : '' ?>" href="/">Accueil</a></li>
                <li class="nav-item"><a class="nav-link <?= $path === '/profile' ? 'active' : '' ?>" href="/profile">Profil</a></li>
                <li class="nav-item"><a class="nav-link <?= $path === '/objectives' ? 'active' : '' ?>" href="/objectives">Objectifs</a></li>
                <li class="nav-item"><a class="nav-link <?= $path === '/recommendations' ? 'active' : '' ?>" href="/recommendations">Recommandations</a></li>
                <li class="nav-item"><a class="nav-link <?= $path === '/wallet' ? 'active' : '' ?>" href="/wallet">Porte-monnaie</a></li>
                <li class="nav-item"><a class="nav-link <?= $path === '/gold' ? 'active' : '' ?>" href="/gold">Option Gold</a></li>
            </ul>
            <div class="d-flex align-items-center gap-3">
                <?php if ($userName): ?>
                    <span class="text-white small">Bonjour <?= esc($userName) ?></span>
                    <a class="btn btn-light btn-sm" href="/logout">Deconnexion</a>
                <?php else: ?>
                    <a class="btn btn-light btn-sm" href="/login">Connexion</a>
                <?php endif; ?>
            </div>
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
