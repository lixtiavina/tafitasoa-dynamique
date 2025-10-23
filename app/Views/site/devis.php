<section id="devis" class="py-20 bg-gradient-to-br from-blue-50 to-gray-50">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold mb-6 text-gray-900">Demandez un devis</h2>
        <p class="mb-10 text-gray-600 max-w-2xl mx-auto">
            Remplissez ce formulaire pour obtenir un devis personnalisé selon vos besoins.
        </p>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('site/envoyerDevis') ?>" method="post" class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-8 space-y-4">
            <input type="text" name="nom" placeholder="Nom complet" class="w-full p-3 border rounded-lg" required>
            <input type="email" name="email" placeholder="Adresse email" class="w-full p-3 border rounded-lg" required>
            <input type="text" name="telephone" placeholder="Téléphone" class="w-full p-3 border rounded-lg">
            <textarea name="message" placeholder="Décrivez votre besoin" rows="4" class="w-full p-3 border rounded-lg" required></textarea>
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">Envoyer</button>
        </form>
    </div>
</section>

