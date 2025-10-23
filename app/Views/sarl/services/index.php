<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Services</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800"> Gestion des Services</h1>

        <!-- ✅ Bouton retour au tableau de bord -->
        <a href="<?= base_url('sarl/dashboard') ?>" 
           class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded-lg shadow flex items-center gap-2 transition">
           ⬅️ <span>Retour au tableau de bord</span>
        </a>
    </div>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <a href="<?= base_url('sarl/services/create') ?>" 
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg mb-6 inline-block shadow transition">
       ➕ Ajouter un service
    </a>

    <div class="grid md:grid-cols-3 gap-6">
        <?php foreach($services as $srv): ?>
            <div class="bg-white shadow rounded-lg p-4 hover:shadow-lg transition">
                <img src="<?= base_url('uploads/services/'.$srv['image']) ?>" 
                     class="rounded-lg h-40 w-full object-cover mb-3">
                <h3 class="text-lg font-semibold text-gray-800"><?= esc($srv['titre']) ?></h3>
                <p class="text-gray-600 text-sm mb-3"><?= esc($srv['description']) ?></p>
                <div class="flex gap-2">
                    <a href="<?= base_url('sarl/services/edit/'.$srv['id']) ?>" 
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded transition">✏️</a>
                    <a href="<?= base_url('sarl/services/delete/'.$srv['id']) ?>" 
                       onclick="return confirm('Supprimer ce service ?')" 
                       class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition">❌</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>
