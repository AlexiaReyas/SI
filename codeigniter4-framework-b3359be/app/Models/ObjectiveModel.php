<?php

namespace App\Models;

use App\Models\BaseMockModel;

class ObjectiveModel extends BaseMockModel
{
    protected $table = 'user_objectives';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'objective',
    ];
}
