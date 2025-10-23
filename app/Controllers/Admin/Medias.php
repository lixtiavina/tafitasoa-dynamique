<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\VideoModel;

class Medias extends BaseController
{
    public function index()
    {
        $videoModel = new VideoModel();
        $data['video'] = $videoModel->first();
        $data['title'] = 'Gestion des Médias';
        
        return view('sarl/medias/index', $data);
    }

    public function updateVideo()
    {
        $videoModel = new VideoModel();
        $url = $this->request->getPost('url');
        $file = $this->request->getFile('fichier');

        $data = [];

        if ($url) {
            $data['url'] = $url;
            $data['fichier'] = null;
        } elseif ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/videos', $newName);
            $data['fichier'] = $newName;
            $data['url'] = null;
        }

        $existing = $videoModel->first();
        if ($existing) {
            $videoModel->update($existing['id'], $data);
        } else {
            $videoModel->insert($data);
        }

        return redirect()->back()->with('success', 'Vidéo mise à jour avec succès.');
    }
}
