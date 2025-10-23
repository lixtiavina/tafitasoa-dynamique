<section id="services" class="py-20 bg-gray-50">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold mb-12 text-gray-900">Nos Services</h2>

        <div class="grid md:grid-cols-3 gap-8">
            <?php if (!empty($services)): ?>
                <?php foreach ($services as $service): ?>
                    <div class="bg-white shadow-md rounded-xl p-6 hover:shadow-lg transition">
                        <img src="<?= base_url('uploads/services/' . $service['image']) ?>" alt="<?= esc($service['titre']) ?>" class="rounded-lg mb-4 w-full h-40 object-cover">
                        <h3 class="text-xl font-semibold mb-2 text-blue-700"><?= esc($service['titre']) ?></h3>
                        <p class="text-gray-600"><?= esc($service['description']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-500">Aucun service disponible pour le moment.</p>
            <?php endif; ?>
        </div>
    </div>
</section>
