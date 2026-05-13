<?php

namespace App\Models;

use App\Models\BaseMockModel;

class HealthModel extends BaseMockModel
{
    protected $table = 'health';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'height_cm',
        'weight_kg',
        'imc',
        'created_at',
        'updated_at',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
