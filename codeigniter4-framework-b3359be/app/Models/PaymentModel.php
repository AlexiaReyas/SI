<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
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
