<?php

namespace App\Models;

use App\Models\BaseMockModel;

class RegimeModel extends BaseMockModel
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
