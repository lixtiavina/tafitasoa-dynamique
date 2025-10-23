<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Parametres extends BaseController
{
    public function index()
    {
        // Charger la vue pour configurer le logo et favicon
        return view('sarl/parametres/parametres', [
            'title' => 'Paramètres du site'
        ]);
    }

    public function save()
    {
        helper(['form', 'url']);

        // Dossier de stockage
        $uploadPath = FCPATH . 'uploads/settings/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // Upload du logo
        $logoFile = $this->request->getFile('logo');
        if ($logoFile && $logoFile->isValid() && !$logoFile->hasMoved()) {
            $logoName = 'logo.' . $logoFile->getExtension();
            $logoFile->move($uploadPath, $logoName, true);
        }

        // Upload du favicon
        $faviconFile = $this->request->getFile('favicon');
        if ($faviconFile && $faviconFile->isValid() && !$faviconFile->hasMoved()) {
            $faviconName = 'favicon.' . $faviconFile->getExtension();
            $faviconFile->move($uploadPath, $faviconName, true);
        }

        session()->setFlashdata('success', 'Paramètres du site mis à jour avec succès.');
        return redirect()->to(base_url('sarl/parametres'));
    }
}
