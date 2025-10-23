<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Service</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <h1 class="text-2xl font-bold mb-6">Modifier le Service</h1>

    <form action="<?= base_url('sarl/services/update/'.$service['id']) ?>" method="post" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md max-w-lg">
        <div class="mb-4">
            <label class="block font-semibold mb-2">Titre</label>
            <input type="text" name="titre" value="<?= esc($service['titre']) ?>" required class="w-full border px-4 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Description</label>
            <textarea name="description" required class="w-full border px-4 py-2 rounded"><?= esc($service['description']) ?></textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Image actuelle</label>
            <img src="<?= base_url('uploads/services/'.$service['image']) ?>" class="rounded-lg w-48 mb-3">
            <input type="file" name="image" class="w-full border px-4 py-2 rounded">
        </div>

        <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded">Mettre à jour</button>
    </form>

</body>
</html>
