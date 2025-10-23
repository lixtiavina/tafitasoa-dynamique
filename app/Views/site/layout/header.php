<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    
    <title><?= esc($title ?? 'Transport à Madagascar | Tafitasoa SARL - Entreprise de Transport, Commission et Collecte') ?></title>
    
    <meta name="description" content="<?= esc($description ?? 'Tafitasoa SARL, entreprise malgache spécialisée dans le transport, la commission et la collecte à Madagascar. Services fiables et professionnels.') ?>">
    <meta name="keywords" content="transport, commission, transport Madagascar, commission de transport, collecte produits locaux, logistique Madagascar, Tafitasoa SARL, Toamasina">
    <meta name="author" content="Tafitasoa SARL">

    <!-- ✅ Open Graph (Facebook, WhatsApp, LinkedIn, etc.) -->
    <meta property="og:title" content="<?= esc($title ?? 'Transport à Madagascar | Tafitasoa SARL') ?>">
    <meta property="og:description" content="<?= esc($description ?? 'Votre partenaire de confiance pour le transport et la logistique à Madagascar.') ?>">
    <meta property="og:image" content="<?= base_url('uploads/settings/logo.jpg') ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:url" content="<?= current_url() ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="fr_FR">

    <!-- ✅ Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= esc($title ?? 'Transport à Madagascar | Tafitasoa SARL') ?>">
    <meta name="twitter:description" content="<?= esc($description ?? 'Tafitasoa SARL, entreprise malgache spécialisée dans le transport, la commission et la collecte à Madagascar.') ?>">
    <meta name="twitter:image" content="<?= base_url('uploads/settings/logo.jpg') ?>">

    <!-- ✅ Canonical -->
    <link rel="canonical" href="<?= current_url() ?>">

    <!-- ✅ Données structurées (Schema.org / JSON-LD) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Tafitasoa SARL",
        "url": "<?= base_url('/') ?>",
        "logo": "<?= base_url('uploads/settings/logo.jpg') ?>",
        "description": "Entreprise malgache spécialisée dans le transport, la commission et la collecte à Madagascar.",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Rue du Port, Quartier Manangareza",
            "addressLocality": "Toamasina",
            "postalCode": "501",
            "addressCountry": "MG"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+261 34 00 000 00",
            "contactType": "Service client"
        },
        "serviceType": ["Transport", "Commission", "Collecte"]
    }
    </script>

    <!-- ✅ Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .hero-bg {
            background-color: #F3F4F6;
        }

        /* Accessibilité : surbrillance des liens au focus clavier */
        a:focus,
        button:focus {
            outline: 2px solid #3B82F6;
            outline-offset: 2px;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- ✅ Header sémantique et accessible -->
    <header class="bg-white shadow-md fixed top-0 left-0 right-0 z-50">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center" aria-label="Navigation principale">
            <a href="<?= base_url('/') ?>" class="flex items-center space-x-2" aria-label="Tafitasoa SARL - Page d'accueil">
                <img src="<?= base_url('uploads/settings/logo.jpg') ?>" alt="Logo Tafitasoa SARL - Entreprise de transport Madagascar" class="h-10 w-auto">
                <span class="text-2xl font-bold text-gray-900">Tafitasoa SARL</span>
            </a>

            <!-- Menu desktop -->
            <div class="hidden md:flex space-x-6">
                <a href="<?= base_url('/') ?>#accueil" class="text-gray-700 hover:text-blue-600 font-medium">Accueil</a>
                <a href="<?= base_url('/') ?>#services" class="text-gray-700 hover:text-blue-600 font-medium">Nos Services</a>
                <a href="<?= base_url('/') ?>#apropos" class="text-gray-700 hover:text-blue-600 font-medium">À propos</a>
                <a href="<?= base_url('/') ?>#contact" class="text-gray-700 hover:text-blue-600 font-medium">Contact</a>
            </div>

            <!-- Bouton menu mobile -->
            <div class="md:hidden">
                <button id="menu-btn" class="text-gray-900" aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="mobile-menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </nav>

        <!-- Menu mobile -->
        <div id="mobile-menu" class="hidden md:hidden bg-white py-4 px-6 shadow-lg">
            <a href="<?= base_url('/') ?>#accueil" class="block py-2 text-gray-700 hover:text-blue-600 font-medium">Accueil</a>
            <a href="<?= base_url('/') ?>#services" class="block py-2 text-gray-700 hover:text-blue-600 font-medium">Nos Services</a>
            <a href="<?= base_url('/') ?>#apropos" class="block py-2 text-gray-700 hover:text-blue-600 font-medium">À propos</a>
            <a href="<?= base_url('/') ?>#contact" class="block py-2 text-gray-700 hover:text-blue-600 font-medium">Contact</a>
        </div>
    </header>

    <div class="pt-24">
