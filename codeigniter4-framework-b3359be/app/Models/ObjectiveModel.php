<?php

namespace App\Models;

use CodeIgniter\Model;

class ObjectiveModel extends Model
{
    protected $table = 'user_objectives';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'objective',
    ];
}
