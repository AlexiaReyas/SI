<?php

namespace App\Controllers;

use App\Models\HealthModel;
use App\Models\UserModel;

class ProfileController extends BaseController
{
    public function index()
    {
        $guard = $this->requireLogin();
        if ($guard) {
            return $guard;
        }

        $userId = (int) $this->session->get('user_id');
        $user = (new UserModel())->find($userId);
        $health = (new HealthModel())->where('user_id', $userId)->first();

        return view('profile/index', [
            'user' => $user,
            'health' => $health,
        ]);
    }

    public function save()
    {
        $guard = $this->requireLogin();
        if ($guard) {
            return $guard;
        }

        $userId = (int) $this->session->get('user_id');
        $name = trim((string) $this->request->getPost('name'));
        $gender = trim((string) $this->request->getPost('gender'));
        $height = (float) $this->request->getPost('height_cm');
        $weight = (float) $this->request->getPost('weight_kg');

        if ($name === '' || $gender === '' || $height <= 0 || $weight <= 0) {
            return redirect()->to('/profile')->with('error', 'Tous les champs sont obligatoires.');
        }

        (new UserModel())->update($userId, [
            'name' => $name,
            'gender' => $gender,
        ]);

        $imc = $this->calculateImc($height, $weight);
        $healthModel = new HealthModel();
        $existing = $healthModel->where('user_id', $userId)->first();
        if ($existing) {
            $healthModel->update($existing['id'], [
                'height_cm' => $height,
                'weight_kg' => $weight,
                'imc' => $imc,
            ]);
        } else {
            $healthModel->insert([
                'user_id' => $userId,
                'height_cm' => $height,
                'weight_kg' => $weight,
                'imc' => $imc,
            ]);
        }

        $this->session->set('user_name', $name);
        return redirect()->to('/profile')->with('success', 'Profil mis a jour.');
    }

    private function calculateImc(float $heightCm, float $weightKg): float
    {
        $heightM = $heightCm / 100;
        return round($weightKg / ($heightM * $heightM), 2);
    }
}
