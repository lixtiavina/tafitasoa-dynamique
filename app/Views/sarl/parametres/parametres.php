<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($title) ?></title>
  
  <!-- ✅ Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- ✅ Icônes Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

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

    .form-container {
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .btn-primary {
      background-color: #0d6efd;
      border-color: #0d6efd;
      transition: 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #0b5ed7;
      border-color: #0a58ca;
    }

    .form-control:focus {
      border-color: #0d6efd;
      box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
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
    <h1>⚙️ Paramètres du site</h1>
    <a href="<?= base_url('sarl/dashboard') ?>" class="btn-back">
      ⬅️ Retour au tableau de bord
    </a>
  </header>

  <!-- ✅ Contenu principal -->
  <div class="container mt-5 mb-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="form-container p-5">
          
          <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="bi bi-check-circle-fill me-2"></i>
              <?= session()->getFlashdata('success') ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          <?php endif; ?>

          <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="bi bi-exclamation-triangle-fill me-2"></i>
              <?= session()->getFlashdata('error') ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          <?php endif; ?>

          <form action="<?= base_url('sarl/parametres/save') ?>" method="post" enctype="multipart/form-data">
            
            <!-- Logo du site -->
            <div class="mb-4">
              <label class="form-label fw-semibold text-gray-700">
                <i class="bi bi-image me-2"></i>Logo du site
              </label>
              <input type="file" name="logo" class="form-control" accept="image/*">
              <div class="form-text">
                Format recommandé : PNG, JPG. Taille maximale : 2MB
              </div>
            </div>

            <!-- Favicon du site -->
            <div class="mb-4">
              <label class="form-label fw-semibold text-gray-700">
                <i class="bi bi-star-fill me-2"></i>Favicon du site
              </label>
              <input type="file" name="favicon" class="form-control" accept="image/x-icon,image/png">
              <div class="form-text">
                Format recommandé : ICO, PNG. Taille : 32x32px ou 16x16px
              </div>
            </div>

            <!-- Boutons d'action -->
            <div class="d-flex justify-content-end gap-3 mt-4">
              <a href="<?= base_url('sarl/dashboard') ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Annuler
              </a>
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-lg me-2"></i>Enregistrer les modifications
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- ✅ Pied de page -->
  <footer>
    © <?= date('Y') ?> Tafitasoa SARL — Panneau Admin
  </footer>

  <!-- ✅ Scripts Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>