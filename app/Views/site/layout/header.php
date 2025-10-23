<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Tafitasoa SARL | Transport à Madagascar') ?></title>
    <meta name="description" content="<?= esc($description ?? 'Entreprise malgache spécialisée dans le transport, la commission et la collecte.') ?>">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .hero-bg { background-color: #F3F4F6; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

<!-- Header -->
<header class="bg-white shadow-md fixed top-0 left-0 right-0 z-50">
    <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
        <a href="<?= base_url('/') ?>" class="flex items-center space-x-2">
            <img src="<?= base_url('uploads/settings/logo.jpg') ?>" alt="Logo Tafitasoa SARL" class="h-10 w-auto">
            <span class="text-2xl font-bold text-gray-900">Tafitasoa SARL</span>
        </a>
        <div class="hidden md:flex space-x-6">
            <a href="<?= base_url('/') ?>#accueil" class="text-gray-700 hover:text-blue-600">Accueil</a>
            <a href="<?= base_url('/') ?>#services" class="text-gray-700 hover:text-blue-600">Nos Services</a>
            <a href="<?= base_url('/') ?>#apropos" class="text-gray-700 hover:text-blue-600">À propos</a>
            <a href="<?= base_url('/') ?>#contact" class="text-gray-700 hover:text-blue-600">Contact</a>
        </div>
        <div class="md:hidden">
            <button id="menu-btn" class="text-gray-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </nav>
</header>

<div class="pt-24">
