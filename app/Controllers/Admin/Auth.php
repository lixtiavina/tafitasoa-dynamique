<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Auth extends BaseController
{
    public function login()
    {
        helper(['form']);
        echo view('sarl/auth/login');
    }

    public function checkLogin()
    {
        $session = session();
        $model = new AdminModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $admin = $model->where('email', $email)->first();

        if ($admin) {
            if (password_verify($password, $admin['password'])) {
                $session->set([
                    'admin_id' => $admin['id'],
                    'admin_name' => $admin['username'],
                    'isLoggedIn' => true
                ]);
                return redirect()->to(base_url('sarl/dashboard'));
            } else {
                $session->setFlashdata('error', 'Mot de passe incorrect');
                return redirect()->back();
            }
        } else {
            $session->setFlashdata('error', 'Email introuvable');
            return redirect()->back();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('sarl/login'));
    }
}
