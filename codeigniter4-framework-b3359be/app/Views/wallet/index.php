<?= view('partials/header', ['title' => 'Portefeuille - NutriFit']) ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-custom p-4 text-center mb-4">
            <h5 class="text-muted">Solde Actuel</h5>
            <h1 class="display-3 fw-bold text-gold mb-3"><?= esc($user['balance'] ?? '0.00') ?> <span class="fs-4">Ar</span></h1>
            <p class="text-muted">Utilisez cet argent pour acheter des options premium (Gold).</p>
        </div>

        <div class="card card-custom p-4">
            <h4 class="fw-bold text-light mb-3"><i class="fa-solid fa-money-bill-wave me-2 text-success"></i>Recharger avec un Code Promo</h4>
            
            <!-- AJAX Formulaire -->
            <form id="promoForm">
                <?= csrf_field() ?>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-dark border-secondary text-light"><i class="fa-solid fa-ticket"></i></span>
                    <input type="text" class="form-control form-control-lg text-uppercase" id="promoCode" name="code" placeholder="ENTREZ VOTRE CODE ICI" required maxlength="15">
                    <button class="btn btn-gold px-4" type="submit" id="btnValider">Valider</button>
                </div>
            </form>
            
            <div id="promoMessage" class="mt-2" style="display: none;"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('promoForm');
    const messageDiv = document.getElementById('promoMessage');
    const btnValider = document.getElementById('btnValider');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        btnValider.disabled = true;
        btnValider.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';
        
        // Simulation AJAX (sera connecté au backend plus tard)
        fetch('<?= base_url('wallet') ?>', {
            method: 'POST',
            body: new FormData(form),
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            messageDiv.style.display = 'block';
            if(data.success) {
                messageDiv.className = 'alert alert-success';
                messageDiv.innerHTML = '<i class="fa-solid fa-check-circle me-2"></i>' + data.message;
                // Rafraîchir la page après 2 secondes pour voir le nouveau solde
                setTimeout(() => window.location.reload(), 2000);
            } else {
                messageDiv.className = 'alert alert-danger';
                messageDiv.innerHTML = '<i class="fa-solid fa-triangle-exclamation me-2"></i>' + data.message;
                btnValider.disabled = false;
                btnValider.innerText = 'Valider';
            }
        })
        .catch(error => {
            messageDiv.style.display = 'block';
            messageDiv.className = 'alert alert-danger';
            messageDiv.innerHTML = '<i class="fa-solid fa-triangle-exclamation me-2"></i>Erreur de connexion au serveur.';
            btnValider.disabled = false;
            btnValider.innerText = 'Valider';
        });
    });
});
</script>

<?= view('partials/footer') ?>
