<?php

namespace App\Controllers\Admin;

use App\Models\AdminModel;
use CodeIgniter\Controller;

class Register extends Controller
{
    protected $adminModel;
    protected $helpers = ['form', 'url', 'date'];

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    /**
     * Afficher le formulaire d'inscription avec liste
     */
    public function index()
    {
        $admins = $this->adminModel->orderBy('created_at', 'DESC')->limit(5)->findAll();

        // Préparer les données avec statut de connexion
        $adminsWithStatus = [];
        foreach ($admins as $admin) {
            $adminsWithStatus[] = [
                'id' => $admin['id'],
                'username' => $admin['username'],
                'email' => $admin['email'],
                'created_at' => $admin['created_at'],
                'is_online' => $this->isAdminOnline($admin['id'])
            ];
        }

        $data = [
            'title' => 'Inscription Administrateur SARL',
            'validation' => \Config\Services::validation(),
            'admins' => $adminsWithStatus,
            'online_count' => array_filter($adminsWithStatus, function ($admin) {
                return $admin['is_online'];
            })
        ];

        return view('sarl/register/admin_register', $data);
    }

    /**
     * Afficher la liste complète des administrateurs
     */
    public function list()
    {
        $admins = $this->adminModel->orderBy('created_at', 'DESC')->findAll();

        // Préparer les données avec statut de connexion
        $adminsWithStatus = [];
        foreach ($admins as $admin) {
            $adminsWithStatus[] = [
                'id' => $admin['id'],
                'username' => $admin['username'],
                'email' => $admin['email'],
                'created_at' => $admin['created_at'],
                'is_online' => $this->isAdminOnline($admin['id']),
                'last_activity' => session()->get('admin_' . $admin['id'] . '_last_activity')
            ];
        }

        $data = [
            'title' => 'Liste Complète des Administrateurs',
            'admins' => $adminsWithStatus,
            'online_count' => array_filter($adminsWithStatus, function ($admin) {
                return $admin['is_online'];
            })
        ];

        return view('sarl/register/admin_list', $data);
    }

    /**
     * Traitement de l'inscription administrateur
     */
    public function processAdminRegistration()
    {
        if (!$this->request->is('post')) {
            return redirect()->to('/sarl/register');
        }

        $rules = [
            'username' => [
                'rules' => 'required|min_length[3]|max_length[50]|is_unique[admins.username]',
                'label' => 'Nom d\'utilisateur'
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[admins.email]',
                'label' => 'Adresse email'
            ],
            'password' => [
                'rules' => 'required|min_length[6]',
                'label' => 'Mot de passe'
            ],
            'password_confirm' => [
                'rules' => 'required|matches[password]',
                'label' => 'Confirmation du mot de passe'
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $adminData = [
            'username'   => $this->request->getPost('username'),
            'email'      => $this->request->getPost('email'),
            'password'    => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s')
        ];

        try {
            $adminId = $this->adminModel->insert($adminData);

            if ($adminId) {
                return redirect()->to('/sarl/register')
                    ->with('success', 'Nouvel administrateur créé avec succès !');
            } else {
                throw new \Exception('Erreur lors de la création du compte administrateur.');
            }
        } catch (\Exception $e) {
            log_message('error', 'Erreur inscription admin: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de l\'inscription: ' . $e->getMessage());
        }
    }

    /**
     * Supprimer un administrateur
     */
    public function delete($id)
    {
        try {
            $admin = $this->adminModel->find($id);

            if (!$admin) {
                throw new \Exception('Administrateur non trouvé.');
            }

            $this->adminModel->delete($id);

            return redirect()->to('/sarl/register/list')
                ->with('success', 'Administrateur supprimé avec succès.');
        } catch (\Exception $e) {
            log_message('error', 'Erreur suppression admin: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }

    /**
     * Vérifier si le username est disponible (AJAX)
     */
    public function checkUsername()
    {
        if ($this->request->isAJAX()) {
            $username = $this->request->getGet('username');
            $exists = $this->adminModel->where('username', $username)->first();
            return $this->response->setJSON(['available' => !$exists]);
        }
        return $this->response->setStatusCode(405);
    }

    /**
     * Vérifier si l'email est disponible (AJAX)
     */
    public function checkEmail()
    {
        if ($this->request->isAJAX()) {
            $email = $this->request->getGet('email');
            $exists = $this->adminModel->where('email', $email)->first();
            return $this->response->setJSON(['available' => !$exists]);
        }
        return $this->response->setStatusCode(405);
    }

    /**
     * Afficher les administrateurs connectés
     */
    public function connectedAdmins()
    {
        $admins = $this->adminModel->orderBy('username', 'ASC')->findAll();

        // Préparer les données avec statut de connexion
        $adminsWithStatus = [];
        foreach ($admins as $admin) {
            $adminsWithStatus[] = [
                'id' => $admin['id'],
                'username' => $admin['username'],
                'email' => $admin['email'],
                'created_at' => $admin['created_at'],
                'is_online' => $this->isAdminOnline($admin['id']),
                'last_activity' => session()->get('admin_' . $admin['id'] . '_last_activity')
            ];
        }

        $data = [
            'title' => 'Administrateurs Connectés',
            'admins' => $adminsWithStatus,
            'online_count' => array_filter($adminsWithStatus, function ($admin) {
                return $admin['is_online'];
            })
        ];

        return view('sarl/register/connected_admins', $data);
    }

    /**
     * Vérifier si un administrateur est en ligne
     */
    private function isAdminOnline($adminId)
    {
        $lastActivity = session()->get('admin_' . $adminId . '_last_activity');
        if (!$lastActivity) {
            return false;
        }

        // Considérer comme en ligne si activité dans les 15 dernières minutes
        return (time() - $lastActivity) < (15 * 60);
    }

    /**
     * Récupérer le statut des administrateurs (AJAX)
     */
    public function getAdminsStatus()
    {
        if ($this->request->isAJAX()) {
            $admins = $this->adminModel->findAll();
            $onlineCount = 0;

            foreach ($admins as $admin) {
                if ($this->isAdminOnline($admin['id'])) {
                    $onlineCount++;
                }
            }

            return $this->response->setJSON([
                'success' => true,
                'online_count' => $onlineCount,
                'offline_count' => count($admins) - $onlineCount,
                'total' => count($admins)
            ]);
        }

        return $this->response->setStatusCode(405);
    }

    /**
     * Mettre à jour l'activité de l'administrateur (AJAX)
     */
    public function updateActivity()
    {
        if ($this->request->isAJAX()) {
            $adminId = session()->get('admin_id');
            if ($adminId) {
                session()->set('admin_' . $adminId . '_last_activity', time());
                return $this->response->setJSON(['success' => true]);
            }
            return $this->response->setJSON(['success' => false, 'message' => 'Admin non connecté']);
        }
        return $this->response->setStatusCode(405);
    }
}
