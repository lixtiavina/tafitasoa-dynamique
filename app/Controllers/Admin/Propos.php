<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProposModel;

class Propos extends BaseController
{
    public function index()
    {
        $model = new ProposModel();
        $data = [
            'title' => 'Modifier la section À propos',
            'propos' => $model->first()
        ];
        return view('sarl/apropos/propos_form', $data);
    }

    public function update()
    {
        $model = new ProposModel();

        $id = $this->request->getPost('id');

        $model->update($id, [
            'title' => $this->request->getPost('title'),
            'phrase' => $this->request->getPost('phrase')
        ]);

        return redirect()->to(base_url('sarl/propos'))->with('success', 'Mise à jour réussie ✅');
    }
}
