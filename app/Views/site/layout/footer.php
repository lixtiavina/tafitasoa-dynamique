</div> <!-- fin du contenu principal -->

<!-- Footer SEO Optimisé -->
<footer class="bg-gray-800 text-white py-10 mt-10" role="contentinfo">
    <div class="container mx-auto px-6 text-center space-y-3">
        <!-- Informations légales -->
        <p class="mb-1">&copy; <?= date('Y') ?> <strong>Tafitasoa SARL</strong>. Tous droits réservés.</p>
        <p class="text-gray-400 text-sm">Entreprise de transport et logistique basée à <strong>Toamasina, Madagascar</strong>.</p>

        <!-- Liens utiles (SEO + maillage interne) -->
        <nav aria-label="Liens de bas de page" class="space-x-4">
            <a href="<?= base_url('/') ?>#accueil" class="hover:text-blue-400 text-sm">Accueil</a>
            <a href="<?= base_url('/') ?>#services" class="hover:text-blue-400 text-sm">Nos Services</a>
            <a href="<?= base_url('/') ?>#apropos" class="hover:text-blue-400 text-sm">À propos</a>
            <a href="<?= base_url('/') ?>#contact" class="hover:text-blue-400 text-sm">Contact</a>
        </nav>

        <!-- Réseaux sociaux (améliore la crédibilité et le SEO local) -->
        <div class="mt-3 space-x-3">
            <a href="https://www.facebook.com/" target="_blank" rel="noopener" aria-label="Page Facebook Tafitasoa SARL">
                <svg class="w-5 h-5 inline fill-current text-blue-400 hover:text-white" viewBox="0 0 24 24">
                    <path d="M22 12c0-5.522-4.478-10-10-10S2 6.478 2 12c0 4.991 3.657 9.128 8.438 9.877v-6.993H8.078v-2.884h2.36V9.797c0-2.337 1.393-3.626 3.523-3.626 1.021 0 2.09.182 2.09.182v2.3h-1.178c-1.162 0-1.525.721-1.525 1.46v1.751h2.594l-.415 2.884h-2.179v6.993C18.343 21.128 22 16.991 22 12z" />
                </svg>
            </a>
            <a href="https://www.linkedin.com/" target="_blank" rel="noopener" aria-label="Profil LinkedIn Tafitasoa SARL">
                <svg class="w-5 h-5 inline fill-current text-blue-400 hover:text-white" viewBox="0 0 24 24">
                    <path d="M19 0h-14c-2.76 0-5 2.24-5 5v14c0 2.76 2.24 5 5 5h14c2.762 0 5-2.24 5-5v-14c0-2.76-2.238-5-5-5zm-11.666 20h-2.833v-10h2.833v10zm-1.417-11.417c-.91 0-1.65-.742-1.65-1.658 0-.917.74-1.658 1.65-1.658.911 0 1.651.741 1.651 1.658 0 .916-.74 1.658-1.651 1.658zm13.083 11.417h-2.833v-5.417c0-1.29-.025-2.948-1.797-2.948-1.8 0-2.078 1.403-2.078 2.853v5.512h-2.833v-10h2.722v1.367h.039c.38-.72 1.306-1.478 2.689-1.478 2.875 0 3.404 1.89 3.404 4.346v5.765z" />
                </svg>
            </a>
        </div>
    </div>
</footer>

<!-- Script d’interaction -->
<script>
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    if (menuBtn && mobileMenu) {
        menuBtn.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
    }

    // Défilement fluide
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', e => {
            e.preventDefault();
            const target = document.querySelector(anchor.getAttribute('href'));
            if (target) target.scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>

</body>

</html>