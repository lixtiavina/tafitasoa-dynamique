<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Liste des Administrateurs' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto p-6">
        <!-- En-tête -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                        </svg>
                        Liste Complète des Administrateurs
                    </h1>
                    <p class="text-gray-600 mt-1">Gestion des comptes administrateurs</p>
                </div>
                <div class="flex gap-3">
                    <a href="<?= base_url('sarl/register') ?>"
                        class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Nouvel Admin
                    </a>
                    <a href="<?= base_url('sarl/dashboard') ?>"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Dashboard
                    </a>
                </div>
            </div>
        </div>

        <!-- Messages d'alerte -->
        <?php if (session()->get('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <?= session()->get('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->get('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <?= session()->get('error') ?>
            </div>
        <?php endif; ?>

        <!-- Statistiques rapides -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-gray-800"><?= count($admins) ?></div>
                <div class="text-sm text-gray-600">Total Admins</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-green-600" id="online-count">
                    <?= count($online_count) ?>
                </div>
                <div class="text-sm text-gray-600">En Ligne</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-red-600" id="offline-count">
                    <?= count($admins) - count($online_count) ?>
                </div>
                <div class="text-sm text-gray-600">Hors Ligne</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-blue-600">
                    <?= count($admins) > 0 ? round((count($online_count) / count($admins)) * 100) : 0 ?>%
                </div>
                <div class="text-sm text-gray-600">Taux Connexion</div>
            </div>
        </div>

        <!-- Tableau des administrateurs -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <?php if (!empty($admins)): ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Administrateur
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Contact
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date d'inscription
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Statut Connexion
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Dernière Activité
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="admins-table-body">
                            <?php foreach ($admins as $admin): ?>
                                <tr class="hover:bg-gray-50 transition duration-150" id="admin-row-<?= $admin['id'] ?>">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="relative flex-shrink-0 h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                                <span class="text-indigo-600 font-bold">
                                                    <?= strtoupper(substr($admin['username'], 0, 2)) ?>
                                                </span>
                                                <!-- Indicateur de statut en ligne -->
                                                <div class="absolute -bottom-1 -right-1 w-3 h-3 <?= $admin['is_online'] ? 'bg-green-500' : 'bg-gray-400' ?> rounded-full border-2 border-white"></div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 flex items-center gap-2">
                                                    <?= esc($admin['username']) ?>
                                                    <?php if ($admin['is_online']): ?>
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs bg-green-100 text-green-800">
                                                            En ligne
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    ID: <?= $admin['id'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900"><?= esc($admin['email']) ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <?= date('d/m/Y', strtotime($admin['created_at'])) ?>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            <?= date('H:i', strtotime($admin['created_at'])) ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $admin['is_online'] ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' ?>">
                                                <?= $admin['is_online'] ? '🟢 En ligne' : '⚫ Hors ligne' ?>
                                            </span>
                                            <?php if ($admin['is_online'] && session()->get('admin_id') == $admin['id']): ?>
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs bg-blue-100 text-blue-800">
                                                    Vous
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <?php if (!empty($admin['last_activity'])): ?>
                                                <span id="last-activity-<?= $admin['id'] ?>">
                                                    <?= timeAgo($admin['last_activity']) ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="text-gray-400">Jamais</span>
                                            <?php endif; ?>
                                        </div>
                                        <?php if (!empty($admin['last_activity'])): ?>
                                            <div class="text-xs text-gray-500">
                                                <?= date('H:i', $admin['last_activity']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex gap-2">
                                            <button class="text-indigo-600 hover:text-indigo-900 transition duration-150">
                                                Modifier
                                            </button>
                                            <?php if (session()->get('admin_id') != $admin['id']): ?>
                                                <a href="<?= base_url('sarl/register/delete/' . $admin['id']) ?>"
                                                    class="text-red-600 hover:text-red-900 transition duration-150"
                                                    onclick="return confirmDelete('<?= addslashes($admin['username']) ?>')">
                                                    Supprimer
                                                </a>
                                            <?php else: ?>
                                                <span class="text-gray-400 cursor-not-allowed">Supprimer</span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Informations de mise à jour -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-600">
                            Total: <strong><?= count($admins) ?></strong> administrateur(s) |
                            <span class="text-green-600" id="online-text"><?= count($online_count) ?> en ligne</span>
                        </div>
                        <div class="text-sm text-gray-600">
                            <span id="last-update">Dernière mise à jour: <?= date('d/m/Y H:i:s') ?></span>
                        </div>
                    </div>
                </div>

            <?php else: ?>
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun administrateur</h3>
                    <p class="text-gray-500 mb-4">Aucun compte administrateur n'a été créé pour le moment.</p>
                    <a href="<?= base_url('sarl/register') ?>"
                        class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg inline-flex items-center gap-2 transition duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Créer le premier administrateur
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Fonction de confirmation pour la suppression
        function confirmDelete(adminName) {
            return confirm('Êtes-vous sûr de vouloir supprimer l\'administrateur "' + adminName + '" ? Cette action est irréversible.');
        }

        // Mettre à jour l'activité de l'admin courant
        function updateAdminActivity() {
            fetch('<?= base_url('sarl/register/update-activity') ?>')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        console.log('Activité admin mise à jour');
                    }
                })
                .catch(error => {
                    console.error('Erreur mise à jour activité:', error);
                });
        }

        // Mettre à jour le statut des admins périodiquement
        function updateAdminsStatus() {
            fetch('<?= base_url('sarl/register/get-admins-status') ?>')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Mettre à jour les compteurs
                        document.getElementById('online-count').textContent = data.online_count;
                        document.getElementById('offline-count').textContent = data.offline_count;
                        document.getElementById('online-text').textContent = data.online_count + ' en ligne';

                        // Mettre à jour la dernière activité
                        const now = new Date();
                        document.getElementById('last-update').textContent =
                            'Dernière mise à jour: ' +
                            now.toLocaleDateString('fr-FR') + ' ' +
                            now.toLocaleTimeString('fr-FR');
                    }
                })
                .catch(error => {
                    console.error('Erreur mise à jour statut:', error);
                });
        }

        // Mettre à jour l'activité toutes les minutes
        setInterval(updateAdminActivity, 60000);

        // Mettre à jour le statut toutes les 30 secondes
        setInterval(updateAdminsStatus, 30000);

        // Mettre à jour aussi sur les interactions utilisateur
        document.addEventListener('click', function() {
            setTimeout(updateAdminActivity, 1000);
        });

        document.addEventListener('keypress', function() {
            setTimeout(updateAdminActivity, 1000);
        });

        // Mettre à jour au chargement de la page
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(updateAdminActivity, 2000);
            setTimeout(updateAdminsStatus, 3000);
        });
    </script>
</body>

</html>