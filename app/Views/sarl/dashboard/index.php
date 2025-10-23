<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Barre supérieure -->
    <nav class="bg-blue-600 p-4 text-white flex justify-between items-center shadow-md">
        <h1 class="text-xl font-semibold">Espace Administrateur</h1>
        <div>
            <span class="mr-4">👋 Bonjour, <strong><?= esc($admin_name) ?></strong></span>
            <a href="<?= base_url('sarl/logout') ?>" class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded">Déconnexion</a>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="p-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Tableau de bord</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Carte : Services -->
            <div class="bg-white shadow rounded-xl p-6 text-center">
                <h3 class="text-gray-600 font-semibold">Nos services</h3>
                <p class="text-3xl font-bold text-yellow-600 mt-2"><?= esc($nb_services) ?></p>
            </div>

            <!-- Carte : Devis -->
            <div class="bg-white shadow rounded-xl p-6 text-center">
                <h3 class="text-gray-600 font-semibold">Devis</h3>
                <p class="text-3xl font-bold text-blue-600 mt-2"><?= esc($nb_devis) ?></p>
            </div>

        </div>

        <!-- ✅ Actions rapides -->
        <div class="mt-10">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Actions rapides</h3>

            <div class="flex flex-wrap justify-between items-center gap-4">
                <!-- Groupe gauche : Autres actions -->
                <div class="flex flex-wrap gap-4">
                    <a href="<?= base_url('sarl/services') ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg shadow">
                        Gérer les services
                    </a>

                    <a href="<?= base_url('sarl/medias') ?>" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow">
                        Changer Vidéo
                    </a>

                    <a href="<?= base_url('sarl/propos') ?>" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow">
                        À propos
                    </a>

                    <a href="<?= base_url('sarl/devis') ?>" class="relative bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow">
                        Voir devis
                        <?php if (!empty($nb_devis)): ?>
                            <span class="absolute -top-2 -right-2 bg-white text-red-600 text-xs font-bold rounded-full px-2 py-0.5 border border-red-600">
                                <?= esc($nb_devis) ?>
                            </span>
                        <?php endif; ?>
                    </a>
                </div>

                <!-- Groupe droit : Paramètres -->
                <a href="<?= base_url('sarl/parametres') ?>"
                    class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-lg shadow flex items-center gap-2">
                    ⚙️ Paramètres du site
                </a>
            </div>
        </div>
    </main>

</body>

</html>