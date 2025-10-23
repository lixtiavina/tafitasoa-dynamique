<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ContactModel;

class Contacts extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new ContactModel();
    }

    public function index()
    {
        $data['contacts'] = $this->model->orderBy('id', 'DESC')->findAll();
        return view('sarl/contacts/index', $data);
    }

    public function create()
    {
        return view('sarl/contacts/create');
    }

    public function store()
    {
        $rules = [
            'adresse' => 'required|min_length[5]|max_length[255]',
            'email' => 'required|valid_email',
            'telf' => 'required|min_length[8]|max_length[20]'
        ];

        $messages = [
            'adresse' => [
                'required' => 'L\'adresse est obligatoire',
                'min_length' => 'L\'adresse doit contenir au moins 5 caractères',
                'max_length' => 'L\'adresse ne doit pas dépasser 255 caractères'
            ],
            'email' => [
                'required' => 'L\'email est obligatoire',
                'valid_email' => 'Veuillez entrer un email valide'
            ],
            'telf' => [
                'required' => 'Le téléphone est obligatoire',
                'min_length' => 'Le téléphone doit contenir au moins 8 caractères',
                'max_length' => 'Le téléphone ne doit pas dépasser 20 caractères'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'adresse' => $this->request->getVar('adresse'),
            'email' => $this->request->getVar('email'),
            'telf' => $this->request->getVar('telf')
        ];

        $this->model->save($data);

        return redirect()->to(base_url('sarl/contacts'))->with('success', 'Contact ajouté avec succès !');
    }

    // Méthodes supplémentaires recommandées
    public function edit($id = null)
    {
        $data['contact'] = $this->model->find($id);
        if (!$data['contact']) {
            return redirect()->to(base_url('sarl/contacts'))->with('error', 'Contact non trouvé');
        }
        return view('sarl/contacts/edit', $data);
    }

    public function update($id = null)
    {
        $rules = [
            'adresse' => 'required|min_length[5]|max_length[255]',
            'email' => 'required|valid_email',
            'telf' => 'required|min_length[8]|max_length[20]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'adresse' => $this->request->getVar('adresse'),
            'email' => $this->request->getVar('email'),
            'telf' => $this->request->getVar('telf')
        ];

        $this->model->update($id, $data);

        return redirect()->to(base_url('sarl/contacts'))->with('success', 'Contact modifié avec succès !');
    }

    public function delete($id = null)
    {
        $contact = $this->model->find($id);
        if (!$contact) {
            return redirect()->to(base_url('sarl/contacts'))->with('error', 'Contact non trouvé');
        }

        $this->model->delete($id);
        return redirect()->to(base_url('sarl/contacts'))->with('success', 'Contact supprimé avec succès !');
    }
}
