<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Devis | Admin</title>

    <!-- ✅ Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ✅ Icônes Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- ✅ Styles personnalisés -->
    <style>
        body {
            background: #f8fafc;
            font-family: "Inter", sans-serif;
        }

        header {
            background-color: #0d6efd;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-size: 1.6rem;
            font-weight: 600;
        }

        /* ✅ Style du bouton retour */
        .btn-back {
            background: white;
            color: #0d6efd;
            padding: 8px 15px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.95rem;
            transition: 0.3s ease;
        }

        .btn-back:hover {
            background: #e9f2ff;
            color: #084298;
            text-decoration: none;
        }

        h2 {
            font-weight: 700;
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
        }

        .btn-danger {
            transition: 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #bb2d3b;
        }

        .badge-repondu {
            background-color: #198754;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
        }

        .badge-en-attente {
            background-color: #6c757d;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
        }

        footer {
            text-align: center;
            padding: 15px;
            margin-top: 30px;
            background: #fff;
            border-top: 1px solid #ddd;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <!-- ✅ En-tête avec bouton -->
    <header>
        <h1>📋 Panneau d'Administration - Devis reçus</h1>
        <a href="<?= base_url('sarl/dashboard') ?>" class="btn-back">
            ⬅️ Retour au tableau de bord
        </a>
    </header>

    <!-- ✅ Contenu principal -->
    <div class="container mt-5 mb-5">
        <h2 class="mb-4 text-center text-primary">Liste des Devis</h2>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <table class="table table-bordered table-hover shadow-sm">
            <thead class="table-primary">
                <tr class="text-center">
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Message</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($devis)): ?>
                    <?php foreach ($devis as $d): ?>
                        <tr>
                            <td><?= esc($d['nom']) ?></td>
                            <td><?= esc($d['email']) ?></td>
                            <td><?= esc($d['telephone']) ?></td>
                            <td><?= esc($d['message']) ?></td>
                            <td class="text-center">
                                <?php if (isset($d['statut']) && $d['statut'] == 'répondu'): ?>
                                    <span class="badge-repondu">
                                        <i class="bi bi-check-circle"></i> Répondu
                                    </span>
                                <?php else: ?>
                                    <span class="badge-en-attente">
                                        <i class="bi bi-clock"></i> En attente
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td><?= esc($d['created_at']) ?></td>
                            <td class="text-center">
                                <?php if (!isset($d['statut']) || $d['statut'] != 'répondu'): ?>
                                    <a href="<?= base_url('sarl/devis/reply/' . $d['id']) ?>"
                                        class="btn btn-sm btn-success me-1">
                                        <i class="bi bi-reply"></i> Répondre
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted small">Déjà répondu</span>
                                <?php endif; ?>
                                
                                <a href="<?= base_url('sarl/devis/delete/' . $d['id']) ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Voulez-vous vraiment supprimer ce devis ?')">
                                    <i class="bi bi-trash"></i> Supprimer
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            Aucun devis reçu pour le moment.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- ✅ Pied de page -->
    <footer>
        © <?= date('Y') ?> Tafitasoa SARL — Panneau Admin
    </footer>

    <!-- ✅ Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>