<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Contacts</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <h1 class="text-2xl font-bold mb-6">Gestion des Contacts</h1>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <a href="<?= base_url('sarl/contacts/create') ?>" class="bg-blue-600 text-white px-4 py-2 rounded mb-6 inline-block">➕ Ajouter un contacts</a>

    <div class="grid md:grid-cols-3 gap-6">
        <?php foreach($contacts as $ctc): ?>
            <div class="bg-white shadow rounded-lg p-4">
                <h3 class="text-lg font-semibold"><?= esc($ctc['adresse']) ?></h3>
                <p class="text-gray-600 text-sm mb-3"><?= esc($ctc['email']) ?></p>
                <p class="text-gray-600 text-sm mb-3"><?= esc($ctc['telf']) ?></p>
                <div class="flex gap-2">
                    <a href="<?= base_url('sarl/contacts/edit/'.$ctc['id']) ?>" class="bg-yellow-500 text-white px-3 py-1 rounded">✏️</a>
                    <a href="<?= base_url('sarl/contacts/delete/'.$ctc['id']) ?>" onclick="return confirm('Supprimer ce service ?')" class="bg-red-500 text-white px-3 py-1 rounded">❌</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>