<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Inscription Administrateur' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">
    <!-- En-tête -->
    <header class="bg-white shadow-sm border-b">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <a href="<?= base_url('sarl/dashboard') ?>" class="flex items-center gap-2 text-gray-700 hover:text-indigo-600 transition duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span class="font-medium">Espace Administrateur</span>
                    </a>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-600"><?= date('d/m/Y') ?></span>
                    <?php if (session()->get('admin_name')): ?>
                        <div class="flex items-center gap-2 bg-indigo-50 px-3 py-1 rounded-full">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <span class="text-sm font-medium text-indigo-700"><?= session()->get('admin_name') ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto p-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Formulaire d'inscription -->
            <div class="lg:col-span-2">
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">
                            Inscription Administrateur
                        </h1>
                        <a href="<?= base_url('sarl/dashboard') ?>"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition duration-200 text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </a>
                    </div>

                    <!-- Messages d'alerte -->
                    <?php if (session()->get('success')): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            <?= session()->get('success') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->get('error')): ?>
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <?= session()->get('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('sarl/register') ?>" method="POST">
                        <?= csrf_field() ?>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Nom d'utilisateur -->
                            <div class="mb-4">
                                <label for="username" class="block text-gray-700 text-sm font-bold mb-2">
                                    Nom d'utilisateur
                                </label>
                                <input type="text"
                                    id="username"
                                    name="username"
                                    value="<?= old('username') ?>"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    required>
                                <?php if (isset($errors['username'])): ?>
                                    <p class="text-red-500 text-xs mt-1"><?= $errors['username'] ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Email -->
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                                    Adresse email
                                </label>
                                <input type="email"
                                    id="email"
                                    name="email"
                                    value="<?= old('email') ?>"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    required>
                                <?php if (isset($errors['email'])): ?>
                                    <p class="text-red-500 text-xs mt-1"><?= $errors['email'] ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Mot de passe -->
                            <div class="mb-4">
                                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">
                                    Mot de passe
                                </label>
                                <input type="password"
                                    id="password"
                                    name="password"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    required>
                                <?php if (isset($errors['password'])): ?>
                                    <p class="text-red-500 text-xs mt-1"><?= $errors['password'] ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Confirmation mot de passe -->
                            <div class="mb-6">
                                <label for="password_confirm" class="block text-gray-700 text-sm font-bold mb-2">
                                    Confirmer le mot de passe
                                </label>
                                <input type="password"
                                    id="password_confirm"
                                    name="password_confirm"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    required>
                                <?php if (isset($errors['password_confirm'])): ?>
                                    <p class="text-red-500 text-xs mt-1"><?= $errors['password_confirm'] ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Bouton d'inscription -->
                        <button type="submit"
                            class="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                            S'inscrire en tant qu'Administrateur
                        </button>
                    </form>

                    <div class="mt-4 text-center">
                        <a href="<?= base_url('sarl/login') ?>" class="text-indigo-500 hover:text-indigo-700 text-sm">
                            Déjà un compte ? Se connecter
                        </a>
                    </div>
                </div>
            </div>

            <!-- Liste des administrateurs -->
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                        </svg>
                        Administrateurs Existants
                    </h2>

                    <!-- Statistiques en temps réel -->
                    <div class="grid grid-cols-2 gap-3 mb-4">
                        <div class="bg-green-50 p-3 rounded-lg text-center">
                            <div class="text-xl font-bold text-green-600" id="online-count"><?= count($online_count) ?></div>
                            <div class="text-xs text-green-700">En ligne</div>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg text-center">
                            <div class="text-xl font-bold text-gray-600" id="total-count"><?= count($admins) ?></div>
                            <div class="text-xs text-gray-700">Total</div>
                        </div>
                    </div>

                    <?php if (isset($admins) && !empty($admins)): ?>
                        <div class="space-y-3" id="admins-list">
                            <?php foreach ($admins as $admin): ?>
                                <div class="border border-gray-200 rounded-lg p-3 hover:bg-gray-50 transition duration-200 admin-item" data-admin-id="<?= $admin['id'] ?>">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="relative">
                                                <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                                    <span class="text-indigo-600 font-bold text-sm">
                                                        <?= strtoupper(substr($admin['username'], 0, 2)) ?>
                                                    </span>
                                                </div>
                                                <!-- Indicateur de statut en temps réel -->
                                                <div class="absolute -bottom-1 -right-1 w-3 h-3 <?= $admin['is_online'] ? 'bg-green-500' : 'bg-gray-400' ?> rounded-full border-2 border-white status-indicator"></div>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-gray-800 text-sm"><?= esc($admin['username']) ?></h3>
                                                <p class="text-xs text-gray-600"><?= esc($admin['email']) ?></p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-xs text-gray-500">
                                                <?= date('d/m/Y', strtotime($admin['created_at'])) ?>
                                            </div>
                                            <div class="status-text text-xs mt-1 <?= $admin['is_online'] ? 'text-green-600' : 'text-gray-500' ?>">
                                                <?= $admin['is_online'] ? '🟢 En ligne' : '⚫ Hors ligne' ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Dernière activité -->
                                    <?php if ($admin['is_online'] && !empty($admin['last_activity'])): ?>
                                        <div class="mt-2 text-xs text-green-600">
                                            Dernière activité: <span class="last-activity"><?= timeAgo($admin['last_activity']) ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Informations de mise à jour -->
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <div class="text-center text-xs text-gray-500">
                                <span id="last-update">Dernière mise à jour: <?= date('H:i:s') ?></span>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                            </svg>
                            <p class="text-gray-500 text-sm">Aucun administrateur inscrit pour le moment</p>
                        </div>
                    <?php endif; ?>

                    <!-- Actions rapides -->
                    <div class="mt-6 space-y-2">
                        <a href="<?= base_url('sarl/register/list') ?>"
                            class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-2 px-4 rounded text-sm font-medium flex items-center justify-center gap-2 transition duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Voir liste complète
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mettre à jour l'activité de l'admin courant
        function updateAdminActivity() {
            fetch('<?= base_url('sarl/register/update-activity') ?>')
                .then(response => {
                    if (!response.ok) throw new Error('Network error');
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        console.log('✅ Activité mise à jour');
                    }
                })
                .catch(error => {
                    console.error('❌ Erreur activité:', error);
                });
        }

        // Mettre à jour le statut des admins en temps réel
        function updateAdminsStatus() {
            fetch('<?= base_url('sarl/register/get-admins-status') ?>')
                .then(response => {
                    if (!response.ok) throw new Error('Network error');
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Mettre à jour les compteurs
                        document.getElementById('online-count').textContent = data.online_count;
                        document.getElementById('total-count').textContent = data.total;

                        // Mettre à jour la dernière activité
                        const now = new Date();
                        document.getElementById('last-update').textContent =
                            'Dernière mise à jour: ' + now.toLocaleTimeString('fr-FR');
                    }
                })
                .catch(error => {
                    console.error('❌ Erreur statut:', error);
                });
        }

        // Vérification de la correspondance des mots de passe
        function checkPasswordMatch() {
            const passwordInput = document.getElementById('password');
            const confirmInput = document.getElementById('password_confirm');

            if (passwordInput.value && confirmInput.value) {
                if (passwordInput.value !== confirmInput.value) {
                    confirmInput.classList.add('border-red-500');
                } else {
                    confirmInput.classList.remove('border-red-500');
                }
            }
        }

        // Initialisation
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const confirmInput = document.getElementById('password_confirm');

            // Événements pour la validation des mots de passe
            if (passwordInput && confirmInput) {
                passwordInput.addEventListener('input', checkPasswordMatch);
                confirmInput.addEventListener('input', checkPasswordMatch);
            }

            // Mettre à jour l'activité immédiatement
            setTimeout(updateAdminActivity, 1000);

            // Mettre à jour les statuts immédiatement
            setTimeout(updateAdminsStatus, 2000);

            // Mettre à jour l'activité sur les interactions utilisateur
            document.addEventListener('click', function() {
                setTimeout(updateAdminActivity, 500);
            });

            document.addEventListener('keypress', function() {
                setTimeout(updateAdminActivity, 500);
            });
        });

        // Mettre à jour l'activité toutes les minutes
        setInterval(updateAdminActivity, 60000);

        // Mettre à jour les statuts toutes les 15 secondes
        setInterval(updateAdminsStatus, 15000);
    </script>
</body>
</html>