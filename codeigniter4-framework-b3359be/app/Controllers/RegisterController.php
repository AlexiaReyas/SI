<?php

namespace App\Controllers;

use App\Models\HealthModel;
use App\Models\UserModel;

class RegisterController extends BaseController
{
    public function step1()
    {
        if ($this->session->get('user_id')) {
            return redirect()->to('/profile');
        }

        return view('auth/register_step1');
    }

    public function step1Save()
    {
        $name = trim((string) $this->request->getPost('name'));
        $email = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');
        $gender = trim((string) $this->request->getPost('gender'));

        if ($name === '' || $email === '' || $password === '' || $gender === '') {
            return redirect()->to('/register-step1')->with('error', 'Tous les champs sont obligatoires.');
        }

        $userModel = new UserModel();
        $existing = $userModel->where('email', $email)->first();
        if ($existing) {
            return redirect()->to('/register-step1')->with('error', 'Email deja utilise.');
        }

        $this->session->set('register_step1', [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'gender' => $gender,
        ]);

        return redirect()->to('/register-step2');
    }

    public function step2()
    {
        if ($this->session->get('user_id')) {
            return redirect()->to('/profile');
        }

        if (!$this->session->get('register_step1')) {
            return redirect()->to('/register-step1');
        }

        return view('auth/register_step2');
    }

    public function step2Save()
    {
        if (!$this->session->get('register_step1')) {
            return redirect()->to('/register-step1');
        }

        $height = (float) $this->request->getPost('height_cm');
        $weight = (float) $this->request->getPost('weight_kg');

        if ($height <= 0 || $weight <= 0) {
            return redirect()->to('/register-step2')->with('error', 'Taille et poids valides requis.');
        }

        $step1 = $this->session->get('register_step1');

        $userId = (new UserModel())->insert([
            'name' => $step1['name'],
            'email' => $step1['email'],
            'password_hash' => password_hash($step1['password'], PASSWORD_BCRYPT),
            'gender' => $step1['gender'],
            'is_admin' => 0,
            'gold' => 0,
            'wallet' => 0.00,
        ], true);

        $imc = $this->calculateImc($height, $weight);
        (new HealthModel())->insert([
            'user_id' => $userId,
            'height_cm' => $height,
            'weight_kg' => $weight,
            'imc' => $imc,
        ]);

        $this->session->remove('register_step1');
        $this->session->set([
            'user_id' => $userId,
            'user_name' => $step1['name'],
            'is_admin' => 0,
            'gold' => 0,
        ]);

        return redirect()->to('/profile');
    }

    private function calculateImc(float $heightCm, float $weightKg): float
    {
        $heightM = $heightCm / 100;
        return round($weightKg / ($heightM * $heightM), 2);
    }
}
