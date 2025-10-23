<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ServiceModel;
use App\Models\DevisModel;
// (optionnel) si tu veux afficher le nombre de visites :
//use App\Models\VisiteModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // 🔐 Vérifie si l'admin est connecté
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('sarl/login'));
        }

        // 🔹 Chargement des modèles
        $serviceModel = new ServiceModel();
        $devisModel   = new DevisModel();
        //$visiteModel  = new VisiteModel(); // optionnel

        // 🔹 Récupération des données
        $nb_services = $serviceModel->countAllResults();
        $nb_devis    = $devisModel->getUnreadCount();
        //$nb_visites  = $visiteModel->countAllResults() ?? 0; // ou fixe, ex: 120

        // ✅ Prépare les données pour la vue
        $data = [
            'title'       => 'Tableau de bord - Admin',
            'admin_name'  => session()->get('admin_name'),
            'nb_services' => $nb_services,
            'nb_devis'    => $nb_devis,
            //'nb_visites'  => $nb_visites,
        ];

        // 🔹 Charge la vue correspondante
        return view('sarl/dashboard/index', $data);
    }
}
