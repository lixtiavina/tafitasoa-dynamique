<section id="video" class="py-20 bg-white">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold mb-8 text-gray-900">Découvrez Nos Activités</h2>

        <?php if (!empty($video)): ?>
            <div class="relative max-w-4xl mx-auto rounded-xl overflow-hidden shadow-lg aspect-video bg-black">
                <?php if (!empty($video['url'])): ?>
                    <?php $embedUrl = str_replace("watch?v=", "embed/", $video['url']); ?>
                    <iframe 
                        class="absolute inset-0 w-full h-full" 
                        src="<?= esc($embedUrl) ?>" 
                        title="Présentation Tafitasoa SARL" 
                        allowfullscreen>
                    </iframe>
                <?php elseif (!empty($video['fichier'])): ?>
                    <video 
                        controls 
                        class="absolute inset-0 w-full h-full object-cover"
                        style="object-position: center;">
                        <source src="<?= base_url('uploads/videos/' . $video['fichier']) ?>" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture vidéo.
                    </video>
                <?php else: ?>
                    <p class="text-gray-500">Aucune vidéo disponible pour le moment.</p>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <p class="text-gray-500">Aucune vidéo disponible pour le moment.</p>
        <?php endif; ?>
    </div>
</section>
