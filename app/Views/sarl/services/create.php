<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Service</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <h1 class="text-2xl font-bold mb-6">Ajouter un Service</h1>

    <form action="<?= base_url('sarl/services/store') ?>" method="post" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md max-w-lg">
        <div class="mb-4">
            <label for="titre" class="block font-semibold mb-2">Titre</label>
            <input type="text" name="titre" id="titre" required class="w-full border px-4 py-2 rounded">
        </div>

        <div class="mb-4">
            <label for="description" class="block font-semibold mb-2">Description</label>
            <textarea name="description" id="description" required class="w-full border px-4 py-2 rounded"></textarea>
        </div>

        <div class="mb-4">
            <label for="image" class="block font-semibold mb-2">Image</label>
            <input type="file" name="image" id="image" required class="w-full border px-4 py-2 rounded">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">Enregistrer</button>
    </form>

</body>
</html>
