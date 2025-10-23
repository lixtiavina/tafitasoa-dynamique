<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Répondre au devis | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .btn-gmail {
            background-color: #ea4335;
            border-color: #ea4335;
            transition: 0.3s ease;
        }
        .btn-gmail:hover {
            background-color: #d33426;
            border-color: #c5221f;
        }
    </style>
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h2 class="text-center text-primary mb-4">✉️ Répondre au devis</h2>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="mb-3">Informations du client :</h5>
                <p><strong>Nom :</strong> <?= esc($devis['nom']) ?></p>
                <p><strong>Email :</strong> <?= esc($devis['email']) ?></p>
                <p><strong>Téléphone :</strong> <?= esc($devis['telephone']) ?></p>
                <p><strong>Message initial :</strong><br><?= nl2br(esc($devis['message'])) ?></p>

                <hr>

                <form id="replyForm" action="<?= base_url('sarl/devis/saveReply') ?>" method="post">
                    <input type="hidden" name="devis_id" value="<?= esc($devis['id']) ?>">
                    <input type="hidden" name="email" value="<?= esc($devis['email']) ?>">

                    <div class="mb-3">
                        <label for="message" class="form-label">Votre réponse</label>
                        <textarea name="reponse_message" id="message" rows="6" class="form-control" placeholder="Écrivez votre réponse ici..." required></textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('sarl/devis') ?>" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                        <button type="button" onclick="saveAndOpenGmail()" class="btn btn-gmail text-white">
                            <i class="bi bi-envelope"></i> Enregistrer et ouvrir Gmail
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        async function saveAndOpenGmail() {
            const message = document.getElementById('message').value;
            const devisId = "<?= esc($devis['id']) ?>";
            const email = "<?= esc($devis['email']) ?>";
            const nom = "<?= esc($devis['nom']) ?>";

            // Vérifier si le message n'est pas vide
            if (!message.trim()) {
                alert('Veuillez écrire votre message avant de continuer.');
                return;
            }

            try {
                // Enregistrer la réponse dans la base de données
                const response = await fetch('<?= base_url('sarl/devis/saveReply') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `devis_id=${devisId}&reponse_message=${encodeURIComponent(message)}&email=${email}`
                });

                const result = await response.json();

                if (result.success) {
                    // Sujet du mail
                    const subject = "Réponse à votre demande de devis - Tafitasoa SARL";

                    // Corps du message en texte simple mais formaté
                    const body = `Bonjour ${nom},

${message}

Cordialement,
L'équipe Tafitasoa SARL
───────────────────────────────
TAFITASOA SARL
Transport - Commission - Collecte
Email: contact@tafitasoa.com
Téléphone: +261 XX XX XXX XX
───────────────────────────────
Message original :
${"<?= esc($devis['message']) ?>"}

---
Cet email a été envoyé depuis le système de gestion des devis de Tafitasoa SARL.`;

                    // Encodage URL
                    const encodedSubject = encodeURIComponent(subject);
                    const encodedBody = encodeURIComponent(body);

                    // Construction de l'URL Gmail
                    const gmailUrl = `https://mail.google.com/mail/?view=cm&fs=1&to=${email}&su=${encodedSubject}&body=${encodedBody}`;

                    // Ouverture dans un nouvel onglet
                    window.open(gmailUrl, '_blank');

                    // Optionnel : afficher un message de succès
                    alert('Réponse enregistrée avec succès ! Ouverture de Gmail...');

                } else {
                    alert('Erreur lors de l\'enregistrement de la réponse: ' + result.message);
                }

            } catch (error) {
                console.error('Erreur:', error);
                alert('Une erreur est survenue lors de l\'enregistrement.');
            }
        }
    </script>

</body>
</html>