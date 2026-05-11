<?php

namespace App\Models;

use App\Models\BaseMockModel;

class UserModel extends BaseMockModel
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'email',
        'password_hash',
        'gender',
        'is_admin',
        'gold',
        'wallet',
        'created_at',
        'updated_at',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
