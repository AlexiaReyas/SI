<?php

namespace App\Controllers;

use App\Models\SettingModel;

class AdminSettingsController extends BaseController
{
    public function index()
    {
        $guard = $this->requireAdmin();
        if ($guard) {
            return $guard;
        }

        $settings = (new SettingModel())->findAll();
        $map = [];
        foreach ($settings as $row) {
            $map[$row['setting_key']] = $row['setting_value'];
        }

        return view('admin/settings/index', [
            'settings' => $map,
        ]);
    }

    public function save()
    {
        $guard = $this->requireAdmin();
        if ($guard) {
            return $guard;
        }

        $fields = [
            'imc_min_normal' => $this->request->getPost('imc_min_normal'),
            'imc_max_normal' => $this->request->getPost('imc_max_normal'),
            'gold_price' => $this->request->getPost('gold_price'),
        ];

        $model = new SettingModel();
        foreach ($fields as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }
            $existing = $model->where('setting_key', $key)->first();
            if ($existing) {
                $model->update($existing['id'], ['setting_value' => $value]);
            } else {
                $model->insert(['setting_key' => $key, 'setting_value' => $value]);
            }
        }

        return redirect()->to('/admin/settings')->with('success', 'Parametres mis a jour.');
    }
}
