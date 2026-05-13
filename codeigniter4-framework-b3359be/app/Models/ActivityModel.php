<?php

namespace App\Models;

use App\Models\BaseMockModel;

class ActivityModel extends BaseMockModel
{
    protected $table = 'activities';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'description',
        'duration_minutes',
    ];
}
