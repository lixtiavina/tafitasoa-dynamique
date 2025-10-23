<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de la Vidéo - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .container {
            max-width: 800px;
        }
        header {
            background: #0d6efd;
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 0 0 12px 12px;
        }
        .btn-back {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.4);
            padding: 0.4rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            transition: 0.2s;
        }
        .btn-back:hover {
            background: white;
            color: #0d6efd;
        }
        .card {
            border-radius: 12px;
        }
    </style>
</head>
<body>

<header>
    <h1 class="m-0">🎬 Gestion de la Vidéo de Présentation</h1>

    <!-- ✅ Bouton à droite -->
    <a href="<?= base_url('sarl/dashboard') ?>" class="btn-back text-decoration-none">
        ⬅️ Retour au tableau de bord
    </a>
</header>

<div class="container mt-5">

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="card shadow-sm p-4">
        <form action="<?= base_url('sarl/medias/updateVideo') ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="fichier" class="form-label">Téléverser une vidéo (MP4, AVI...)</label>
                <input type="file" name="fichier" id="fichier" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary w-100">Mettre à jour</button>
        </form>
    </div>

    <div class="mt-5">
        <h4>🎥 Aperçu actuel :</h4>

        <?php if (!empty($video['url'])): ?>
            <div class="ratio ratio-16x9 mt-3">
                <iframe src="<?= esc($video['url']) ?>" title="Vidéo" allowfullscreen></iframe>
            </div>
        <?php elseif (!empty($video['fichier'])): ?>
            <video controls class="w-100 mt-3 rounded shadow-sm">
                <source src="<?= base_url('uploads/videos/' . $video['fichier']) ?>" type="video/mp4">
                Votre navigateur ne supporte pas la lecture vidéo.
            </video>
        <?php else: ?>
            <p class="text-muted mt-3">Aucune vidéo enregistrée pour le moment.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
