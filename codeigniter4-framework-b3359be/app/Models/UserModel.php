<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\BaseMockModel;

class UserModel extends BaseMockModel
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'name',
        'email',
        'password_hash',
        'gender',
        'is_admin',
        'gold',
        'wallet',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
