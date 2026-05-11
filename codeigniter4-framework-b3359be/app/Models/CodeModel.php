<?php

namespace App\Models;

use App\Models\BaseMockModel;

class CodeModel extends BaseMockModel
{
    protected $table = 'codes';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'code',
        'amount',
        'is_valid',
        'used_by',
        'used_at',
    ];
}
