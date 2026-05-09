<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Healthy Diet - Atteignez vos objectifs') ?></title>
    
    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<<<<<<< HEAD
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('css/app.css') ?>">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom mb-4">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <i class="fa-solid fa-leaf text-gold me-2"></i>NutriFit
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if(session()->get('isLoggedIn')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('dashboard') ?>">Tableau de bord</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('profile') ?>">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-warning" href="<?= base_url('gold') ?>">
                                <i class="fa-solid fa-crown"></i> Mode Gold
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('logout') ?>">Déconnexion</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('login') ?>">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-gold ms-2 px-4" href="<?= base_url('register-step1') ?>">S'inscrire</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Main Content Container -->
    <div class="container flex-grow-1">
=======
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Source+Serif+4:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-semibold" href="/">Regime</a>
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
            <div class="d-flex align-items-center gap-2">
                <?php if ($userName): ?>
                    <span class="text-white small">Bonjour <?= esc($userName) ?></span>
                    <a class="btn btn-light btn-sm" href="/logout">Deconnexion</a>
                <?php else: ?>
                    <a class="btn btn-outline-light btn-sm" href="/login">Connexion</a>
                    <a class="btn btn-light btn-sm" href="/register-step1">Inscription</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
<main class="container py-4 page-shell">
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
<?php endif; ?>
>>>>>>> front
