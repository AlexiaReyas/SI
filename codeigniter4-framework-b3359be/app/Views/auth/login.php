<?= view('partials/header', ['title' => 'Connexion - NutriFit']) ?>

<div class="row justify-content-center align-items-center mt-5">
    <div class="col-md-5 col-lg-4">
        <div class="card card-custom p-4">
            <div class="text-center mb-4">
                <i class="fa-solid fa-leaf text-gold fa-3x mb-3"></i>
                <h2 class="fw-bold">Bon retour !</h2>
                <p class="text-muted">Connectez-vous pour voir vos objectifs</p>
            </div>

            <form action="<?= base_url('login') ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="mb-3">
                    <label for="email" class="form-label text-light">Adresse Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark text-gold border-secondary"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="email" required placeholder="nom@exemple.com">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label text-light">Mot de passe</label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark text-gold border-secondary"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" required placeholder="********">
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-gold btn-lg">Se connecter</button>
                </div>
            </form>

            <div class="text-center mt-4">
                <p class="text-muted mb-0">Pas encore de compte ? <a href="<?= base_url('register-step1') ?>" class="text-gold text-decoration-none">S'inscrire</a></p>
            </div>
        </div>
    </div>
</div>

<?= view('partials/footer') ?>
