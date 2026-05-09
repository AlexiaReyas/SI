<?php

namespace App\Models;

use CodeIgniter\Model;

class UtilisationCodeModel extends Model
{
    protected $table = 'utilisation_codes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'code_id', 'date_utilisation'];
}