    </div> <!-- End Main Content Container -->

    <footer class="mt-5 py-4 text-center" style="background-color: var(--dark-surface); border-top: 1px solid rgba(212, 175, 55, 0.2);">
        <div class="container">
            <p class="mb-0 text-muted">&copy; <?= date('Y') ?> NutriFit. Atteignez votre IMC idéal. <br>
                <small>Crédits : Alexia (Frontend) | Midera (Backend) | Andhy (BDD & Intégration)</small>
            </p>
        </div>
    </footer>

    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery (pour les requêtes AJAX facilitées) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Toasts Bootstrap de succès/erreur -->
    <?php if(session()->getFlashdata('success') || session()->getFlashdata('error')): ?>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <?php if(session()->getFlashdata('success')): ?>
        <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fa-solid fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('error')): ?>
        <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i> <?= session()->getFlashdata('error') ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</body>
</html>

<script>
// Theme toggle: remember choice in localStorage
(function(){
    try {
        const body = document.documentElement;
        const btn = document.getElementById('themeToggle');
        const icon = document.getElementById('themeIcon');
        const stored = localStorage.getItem('siteTheme');
        if (stored === 'light') {
            body.classList.add('theme-light');
            if (icon) icon.className = 'fa-solid fa-sun';
        }
        if (btn) btn.addEventListener('click', function(){
            const isLight = body.classList.toggle('theme-light');
            localStorage.setItem('siteTheme', isLight ? 'light' : 'dark');
            if (icon) icon.className = isLight ? 'fa-solid fa-sun' : 'fa-solid fa-moon';
        });
    } catch (e) {
        console.warn('Theme toggle failed', e);
    }
})();
</script>
