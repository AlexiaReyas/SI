<?php

namespace App\Models;

use App\Models\BaseMockModel;

class SettingModel extends BaseMockModel
{
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'setting_key',
        'setting_value',
    ];
}
