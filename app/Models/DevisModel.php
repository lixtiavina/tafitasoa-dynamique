<?php

namespace App\Models;

use CodeIgniter\Model;

class DevisModel extends Model
{
    protected $table = 'devis';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nom', 'email', 'telephone', 'message', 'created_at','updated_at','is_read','reponse_message','statut'];
    protected $useTimestamps = true;

    // 🔸 Récupère uniquement les devis non lus
    public function getUnreadCount()
    {
        return $this->where('is_read', 0)->countAllResults();
    }

    // 🔸 Marque tous les devis comme lus
    public function markAllAsRead()
    {
        return $this->where('is_read', 0)->set(['is_read' => 1])->update();
    }
}
