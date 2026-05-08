<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Regime - Accueil</title>
    <meta name="description" content="Regime - recommandations nutritionnelles et objectives">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Source+Serif+4:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="#">Regime</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="#hero">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#benefits">Avantages</a></li>
                    <li class="nav-item"><a class="nav-link" href="#process">Etapes</a></li>
                    <li class="nav-item"><a class="nav-link" href="#gold">Gold</a></li>
                </ul>
                <div class="d-flex gap-2 ms-lg-3">
                    <a class="btn btn-outline-light" href="#">Connexion</a>
                    <a class="btn btn-light" href="#">Inscription</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <section id="hero" class="hero section-pad">
            <div class="container">
                <div class="row align-items-center g-4">
                    <div class="col-lg-6">
                        <span class="badge text-bg-light border mb-3">Recommandations personnalisees</span>
                        <h1 class="display-5 fw-semibold mb-3">Prenez en main votre equilibre nutritionnel.</h1>
                        <p class="lead text-muted">Calculez votre IMC, fixez vos objectifs, et recevez un regime et une activite adaptes a votre profil.</p>
                        <div class="d-flex flex-wrap gap-2 mt-4">
                            <a class="btn btn-brand btn-lg" href="#">Commencer</a>
                            <a class="btn btn-outline-secondary btn-lg" href="#benefits">Voir les avantages</a>
                        </div>
                        <div class="d-flex gap-4 mt-4">
                            <div class="stat">
                                <h3 class="mb-0">+15%</h3>
                                <span>Reduction Gold</span>
                            </div>
                            <div class="stat">
                                <h3 class="mb-0">3</h3>
                                <span>Objectifs max</span>
                            </div>
                            <div class="stat">
                                <h3 class="mb-0">100%</h3>
                                <span>Personnalise</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="hero-card p-4 p-lg-5">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div>
                                    <p class="text-muted mb-1">IMC actuel</p>
                                    <h4 class="mb-0">22.4</h4>
                                </div>
                                <span class="badge badge-goal">Equilibre</span>
                            </div>
                            <div class="soft-bg p-3 rounded-4 mb-3">
                                <p class="mb-1 fw-semibold">Regime recommande</p>
                                <p class="mb-0 text-muted">Mediterraneen, 30 jours, -2.0 kg</p>
                            </div>
                            <div class="soft-bg p-3 rounded-4 mb-3">
                                <p class="mb-1 fw-semibold">Activite suggeree</p>
                                <p class="mb-0 text-muted">Marche rapide, 45 min, 3x/semaine</p>
                            </div>
                            <div class="d-flex justify-content-between text-muted small">
                                <span>Suivi en temps reel</span>
                                <span>Export PDF</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="benefits" class="section-pad">
            <div class="container">
                <div class="row align-items-end mb-4">
                    <div class="col-lg-6">
                        <h2 class="section-title">Une experience claire et rassurante.</h2>
                        <p class="text-muted">Tout ce dont vous avez besoin pour avancer sereinement, sans complexite.</p>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="card feature-card p-4 h-100">
                            <h5>Profil complet</h5>
                            <p class="text-muted mb-0">Informations sante et objectifs centralises en un seul endroit.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card feature-card p-4 h-100">
                            <h5>Recommandations ciblees</h5>
                            <p class="text-muted mb-0">Regime + activite adaptes a votre evolution.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card feature-card p-4 h-100">
                            <h5>Suivi visuel</h5>
                            <p class="text-muted mb-0">Graphiques IMC, statistiques et tableau de bord.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="process" class="section-pad">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-5">
                        <h2 class="section-title">Votre parcours en 3 etapes.</h2>
                        <p class="text-muted">Simple, rapide, et guide pas a pas.</p>
                    </div>
                    <div class="col-lg-7">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="card step-card p-3 h-100">
                                    <span class="step-index">01</span>
                                    <h6 class="mt-3">Mesurer IMC</h6>
                                    <p class="text-muted mb-0">Taille, poids, calcul automatique.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card step-card p-3 h-100">
                                    <span class="step-index">02</span>
                                    <h6 class="mt-3">Choisir objectifs</h6>
                                    <p class="text-muted mb-0">Jusqua 3 objectifs simultanes.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card step-card p-3 h-100">
                                    <span class="step-index">03</span>
                                    <h6 class="mt-3">Recevoir plan</h6>
                                    <p class="text-muted mb-0">Regime, sport, suivi et PDF.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="gold" class="section-pad">
            <div class="container">
                <div class="cta-panel p-4 p-lg-5">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-7">
                            <h2 class="mb-2">Passez en Gold pour economiser 15%.</h2>
                            <p class="text-muted mb-0">Acces premium, remise sur tous les regimes, et priorite support.</p>
                        </div>
                        <div class="col-lg-5 text-lg-end">
                            <a class="btn btn-brand btn-lg" href="#">Decouvrir Gold</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer section-pad pt-4">
        <div class="container">
            <div class="row g-3 align-items-center">
                <div class="col-lg-6">
                    <h5 class="mb-1">Regime</h5>
                    <p class="text-muted mb-0">Accompagnement nutritionnel moderne et rassurant.</p>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <div class="footer-links">
                        <a href="#">Support</a>
                        <a href="#">Conditions</a>
                        <a href="#">Contact</a>
                    </div>
                </div>
            </div>
            <div class="text-muted small mt-3">&copy; <?= date('Y') ?> Regime. Tous droits reserves.</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
