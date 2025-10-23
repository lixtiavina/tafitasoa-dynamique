<?php

namespace App\Models;

use CodeIgniter\Model;

class VideoModel extends Model
{
    protected $table = 'presentation_video';
    protected $primaryKey = 'id';
    protected $allowedFields = ['url', 'fichier', 'created_at'];
}
