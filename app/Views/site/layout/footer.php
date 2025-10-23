</div> <!-- fin du contenu principal -->

<!-- Footer -->
<footer class="bg-gray-800 text-white py-8">
    <div class="container mx-auto px-6 text-center">
        <p class="mb-2">&copy; <?= date('Y') ?> Tafitasoa SARL. Tous droits réservés.</p>
        <p class="text-gray-400 text-sm">Entreprise de transport et logistique basée à Toamasina, Madagascar</p>
    </div>
</footer>

<script>
const menuBtn = document.getElementById('menu-btn');
const mobileMenu = document.getElementById('mobile-menu');
if(menuBtn && mobileMenu){
    menuBtn.addEventListener('click', ()=> mobileMenu.classList.toggle('hidden'));
}

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', e => {
        e.preventDefault();
        const target = document.querySelector(anchor.getAttribute('href'));
        if (target) target.scrollIntoView({ behavior: 'smooth' });
    });
});
</script>

</body>
</html>
