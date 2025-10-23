<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ServiceModel;

class Services extends BaseController
{
    public function index()
    {
        $model = new ServiceModel();
        $data['services'] = $model->orderBy('id', 'DESC')->findAll();
        return view('sarl/services/index', $data);
    }

    public function create()
    {
        return view('sarl/services/create');
    }

    public function store()
    {
        $model = new ServiceModel();
        $validation = \Config\Services::validation();

        $rules = [
            'titre' => 'required|min_length[3]',
            'description' => 'required',
            'image' => 'uploaded[image]|is_image[image]|max_size[image,2048]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Upload image
        $file = $this->request->getFile('image');
        $fileName = $file->getRandomName();
        $file->move('uploads/services', $fileName);

        $model->save([
            'titre' => $this->request->getVar('titre'),
            'description' => $this->request->getVar('description'),
            'image' => $fileName
        ]);

        return redirect()->to(base_url('sarl/services'))->with('success', 'Service ajouté avec succès !');
    }

    public function edit($id)
    {
        $model = new ServiceModel();
        $data['service'] = $model->find($id);
        return view('admin/services/edit', $data);
    }

    public function update($id)
    {
        $model = new ServiceModel();
        $data = $model->find($id);

        $file = $this->request->getFile('image');
        $newImage = $data['image'];

        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move('uploads/services', $fileName);
            if (is_file('uploads/services/' . $data['image'])) {
                unlink('uploads/services/' . $data['image']);
            }
            $newImage = $fileName;
        }

        $model->update($id, [
            'titre' => $this->request->getVar('titre'),
            'description' => $this->request->getVar('description'),
            'image' => $newImage
        ]);

        return redirect()->to(base_url('sarl/services'))->with('success', 'Service modifié avec succès !');
    }

    public function delete($id)
    {
        $model = new ServiceModel();
        $service = $model->find($id);

        if ($service && is_file('uploads/services/' . $service['image'])) {
            unlink('uploads/services/' . $service['image']);
        }

        $model->delete($id);
        return redirect()->back()->with('success', 'Service supprimé avec succès.');
    }
}
