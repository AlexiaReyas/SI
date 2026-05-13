<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Healthy Diet - Atteignez vos objectifs') ?></title>
    
    <!-- Google Fonts: Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Source+Serif+4:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
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
                    <li class="nav-item d-flex align-items-center me-2">
                        <button id="themeToggle" class="btn theme-toggle" title="Changer le thème">
                            <i id="themeIcon" class="fa-solid fa-moon"></i>
                        </button>
                    </li>
                    <?php if (session()->get('user_id')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('profile') ?>">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('objectives') ?>">Objectifs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('recommendations') ?>">Suggestions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('wallet') ?>">Porte-monnaie</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-warning" href="<?= base_url('gold') ?>">
                                <i class="fa-solid fa-crown"></i> Mode Gold
                            </a>
                        </li>
                        <?php if (session()->get('is_admin')): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Admin
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="adminDropdown">
                                    <li><a class="dropdown-item" href="<?= base_url('admin') ?>">Dashboard</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('admin/regimes') ?>">Regimes</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('admin/activities') ?>">Activites</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('admin/codes') ?>">Codes promo</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('admin/settings') ?>">Parametres</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('logout') ?>">Déconnexion</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('login') ?>">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('register-step1') ?>">Inscription</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('register-step2') ?>">Inscription (Etape 2)</a>
                        </li>
                    <?php endif; ?>
                </ul>
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
