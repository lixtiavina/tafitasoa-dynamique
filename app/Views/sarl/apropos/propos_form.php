<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Modifier - À propos de nous') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen font-sans">

    <!-- Barre supérieure -->
    <nav class="bg-blue-700 text-white px-6 py-4 flex justify-between items-center shadow">
        <h1 class="text-xl font-semibold">Panneau d’administration</h1>
        <a href="<?= base_url('sarl/dashboard') ?>" class="hover:underline text-sm">← Retour au tableau de bord</a>
    </nav>

    <!-- Conteneur principal -->
    <div class="max-w-4xl mx-auto mt-10 bg-white shadow-lg rounded-2xl p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">📝 Modifier la section "À propos de nous"</h2>

        <!-- Message de succès -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                ✅ <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- Formulaire -->
        <form action="<?= base_url('sarl/propos/update') ?>" method="post" class="space-y-6">
            <input type="hidden" name="id" value="<?= isset($propos['id']) ? esc($propos['id']) : '' ?>">

            <!-- Titre -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Titre de la section :</label>
                <input type="text" name="title"
                    value="<?= isset($propos['title']) ? esc($propos['title']) : '' ?>"
                    placeholder="Ex: Qui sommes-nous ?"
                    class="w-full border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none rounded-lg px-4 py-2 text-gray-700">
            </div>

            <!-- Contenu -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Contenu :</label>
                <textarea name="phrase" rows="8"
                    placeholder="Écrivez ici le texte de présentation de votre entreprise..."
                    class="w-full border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none rounded-lg px-4 py-2 text-gray-700"><?= isset($propos['phrase']) ? esc($propos['phrase']) : '' ?></textarea>
            </div>

            <!-- Boutons -->
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition duration-200">
                    💾 Enregistrer les modifications
                </button>
                <a href="<?= base_url('admin/dashboard') ?>"
                    class="text-gray-600 hover:text-blue-600 font-medium transition">
                    Annuler
                </a>
            </div>
        </form>
    </div>

    <!-- Pied de page -->
    <footer class="text-center text-gray-500 text-sm mt-10 py-4 border-t">
        © <?= date('Y') ?> Société Tafitasoa SARL — Interface administrateur
    </footer>

</body>

</html>