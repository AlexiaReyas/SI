<?php

namespace App\Models;

use App\Models\BaseMockModel;

class PaymentModel extends BaseMockModel
{
    protected $table = 'payments';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'amount',
        'type',
        'created_at',
    ];
    protected $useTimestamps = false;
}
