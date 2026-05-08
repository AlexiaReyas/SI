<?php

namespace App\Models;

use CodeIgniter\Model;

class RegimeModel extends Model
{
    protected $table = 'regimes';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'description',
        'base_price',
        'duration_days',
        'weight_change_kg',
        'pct_meat',
        'pct_fish',
        'pct_poultry',
    ];
}
