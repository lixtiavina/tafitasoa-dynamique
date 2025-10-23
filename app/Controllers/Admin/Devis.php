<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DevisModel;
use App\Models\HistoriqueModel;
use Config\Services;

class Devis extends BaseController
{
    protected $model;
    protected $email;

    public function __construct()
    {
        $this->model = new DevisModel();
        $this->email = Services::email();
    }

    public function index()
    {
        $data = [
            'devis' => $this->model->orderBy('created_at', 'DESC')->findAll(),
            'title' => 'Gestion des devis'
        ];

        $this->model->markAllAsRead();

        return view('sarl/devis/index', $data);
    }

    public function delete($id = null)
    {
        if (!$id) {
            return redirect()->back()->with('error', 'ID manquant');
        }

        if ($this->model->delete($id)) {
            return redirect()->back()->with('success', 'Demande supprimée avec succès');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de la suppression');
        }
    }

    public function reply($id = null)
    {
        if (!$id) {
            return redirect()->back()->with('error', 'ID manquant');
        }

        $devis = $this->model->find($id);

        if (!$devis) {
            return redirect()->back()->with('error', 'Devis introuvable');
        }

        $data = [
            'devis' => $devis,
            'title' => 'Répondre au devis'
        ];

        return view('sarl/devis/devis_reply', $data);
    }

    public function sendReply()
    {
        // Validation des données
        $rules = [
            'email' => 'required|valid_email',
            'message' => 'required|min_length[10]',
            'devis_id' => 'required|is_natural_no_zero'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $emailClient = $this->request->getPost('email');
        $message = $this->request->getPost('message');
        $devisId = $this->request->getPost('devis_id');

        // Vérifier que le devis existe
        $devis = $this->model->find($devisId);
        if (!$devis) {
            return redirect()->back()->with('error', 'Devis introuvable');
        }

        // Configuration de l'email
        $this->email->setTo($emailClient);
        $this->email->setFrom('alixtiav@gmail.com', 'Tafitasoa SARL');
        $this->email->setSubject('Réponse à votre demande de devis');
        $this->email->setMessage($this->formatEmailMessage($message));

        if ($this->email->send()) {
            // Marquer comme répondu dans la base de données
            $this->model->update($devisId, ['replied_at' => date('Y-m-d H:i:s')]);

            return redirect()->to('sarl/devis')->with('success', 'Réponse envoyée avec succès à ' . $emailClient);
        } else {
            log_message('error', 'Échec envoi email: ' . $this->email->printDebugger());
            return redirect()->back()->with('error', 'Échec de l\'envoi de l\'email. Veuillez réessayer.');
        }
    }

    /**
     * Formatage du message email
     */
    private function formatEmailMessage($message)
    {
        return "
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; }
                    .header { background: #f4f4f4; padding: 20px; }
                    .content { padding: 20px; }
                    .footer { background: #f4f4f4; padding: 10px; text-align: center; }
                </style>
            </head>
            <body>
                <div class='header'>
                    <h2>Tafitasoa SARL</h2>
                </div>
                <div class='content'>
                    " . nl2br(htmlspecialchars($message)) . "
                </div>
                <div class='footer'>
                    <p>Cordialement,<br>L'équipe Tafitasoa SARL</p>
                </div>
            </body>
            </html>
        ";
    }
    
    public function saveReply()
    {
        // Vérifier si c'est une requête AJAX
        if ($this->request->getMethod() === 'POST') {
            $devisId = $this->request->getPost('devis_id');
            $reponseMessage = $this->request->getPost('reponse_message');
            $email = $this->request->getPost('email');

            // Validation
            if (empty($devisId) || empty($reponseMessage)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Données manquantes'
                ]);
            }

            try {
                // Mettre à jour le devis avec la réponse
                $devisModel = new \App\Models\DevisModel();
                
                $data = [
                    'reponse_message' => $reponseMessage,
                    'reponse_date' => date('Y-m-d H:i:s'),
                    'statut' => 'répondu'
                ];

                $devisModel->update($devisId, $data);

                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Réponse enregistrée avec succès'
                ]);

            } catch (\Exception $e) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Erreur base de données: ' . $e->getMessage()
                ]);
            }
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Méthode non autorisée'
        ]);
    }

    /**
     * Marquer un devis comme lu
     */
    public function markAsRead($id = null)
    {
        if (!$id) {
            return redirect()->back()->with('error', 'ID manquant');
        }

        if ($this->model->update($id, ['read_at' => date('Y-m-d H:i:s')])) {
            return redirect()->back()->with('success', 'Devis marqué comme lu');
        } else {
            return redirect()->back()->with('error', 'Erreur lors du marquage');
        }
    }
}
