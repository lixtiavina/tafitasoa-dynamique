<?php

namespace App\Models;

use CodeIgniter\Model;

class ProposModel extends Model
{
    protected $table = 'propos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'phrase'];
}
