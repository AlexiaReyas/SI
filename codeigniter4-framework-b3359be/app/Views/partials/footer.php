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
