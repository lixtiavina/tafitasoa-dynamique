<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un contact</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <h1 class="text-2xl font-bold mb-6">Ajouter un contact</h1>

    <form action="<?= base_url('sarl/contacts/update/'.$contact['id']) ?>" method="post" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md max-w-lg">
        <div class="mb-4">
            <label for="adresse" class="block font-semibold mb-2">Adresse</label>
            <textarea name="adresse" id="adresse" required class="w-full border px-4 py-2 rounded"><?= esc($contact['adresse']) ?></textarea>
        </div>
        <div class="mb-4">
            <label for="email" class="block font-semibold mb-2">E-mail</label>
            <input type="email" name="email" id="email" required class="w-full border px-4 py-2 rounded" value="<?= esc($contact['email']) ?>">
        </div>
        <div class="mb-4">
            <label for="talf" class="block font-semibold mb-2">Phone</label>
            <input type="text" name="telf" id="telf" required class="w-full border px-4 py-2 rounded" value="<?= esc($contact['telf']) ?>">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">Enregistrer</button>
    </form>

</body>
</html>
