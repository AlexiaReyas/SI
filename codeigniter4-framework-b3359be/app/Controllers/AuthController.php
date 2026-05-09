<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login(): string
    {
        return view('auth/login');
    }

    public function loginPost()
    {
        $email = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');

        if ($email === '' || $password === '') {
            return redirect()->back()->with('error', 'Email et mot de passe requis.');
        }

        $user = (new UserModel())->findByEmail($email);

        if (! $user || ! password_verify($password, (string) $user['mot_de_passe'])) {
            return redirect()->back()->with('error', 'Identifiants invalides.');
        }

        $this->session->set([
            'user_id' => (int) $user['id'],
            'user_name' => (string) $user['nom'],
            'user_email' => (string) $user['email'],
            'is_admin' => 0,
            'is_gold' => (int) ($user['est_gold'] ?? 0),
            'is_logged_in' => true,
        ]);

        return redirect()->to('/profile')->with('success', 'Connexion reussie.');
    }

    public function registerStep1(): string
    {
        return view('auth/register_step1');
    }

    public function registerStep1Post()
    {
        $name = trim((string) $this->request->getPost('name'));
        $email = trim((string) $this->request->getPost('email'));

        if ($name === '' || $email === '') {
            return redirect()->back()->with('error', 'Nom et email requis.');
        }

        $this->session->set([
            'reg_name' => $name,
            'reg_email' => $email,
        ]);

        return redirect()->to('/register/step2');
    }

    public function registerStep2(): string
    {
        return view('auth/register_step2');
    }

    public function registerStep2Post()
    {
        $password = (string) $this->request->getPost('password');
        $confirm = (string) $this->request->getPost('password_confirm');

        if ($password === '' || $confirm === '' || $password !== $confirm) {
            return redirect()->back()->with('error', 'Mot de passe invalide.');
        }

        $name = (string) $this->session->get('reg_name');
        $email = (string) $this->session->get('reg_email');

        if ($name === '' || $email === '') {
            return redirect()->to('/register-step1')->with('error', 'Veuillez recommencer l\'inscription.');
        }

        $userModel = new UserModel();

        if ($userModel->findByEmail($email)) {
            return redirect()->to('/register-step1')->with('error', 'Cet email existe deja.');
        }

        $userId = $userModel->insert([
            'nom' => $name,
            'email' => $email,
            'mot_de_passe' => password_hash($password, PASSWORD_DEFAULT),
            'genre' => null,
            'taille' => null,
            'poids_initial' => null,
            'est_gold' => 0,
            'date_inscription' => date('Y-m-d H:i:s'),
        ], true);

        $this->session->remove(['reg_name', 'reg_email']);

        $this->session->set([
            'user_id' => (int) $userId,
            'user_name' => $name,
            'user_email' => $email,
            'is_admin' => 0,
            'is_gold' => 0,
            'is_logged_in' => true,
        ]);

        return redirect()->to('/profile')->with('success', 'Inscription terminee.');
    }

    public function logout()
    {
        $this->session->destroy();

        return redirect()->to('/login');
    }

    public function imc()
    {
        helper('imc');

        $weight = (float) ($this->request->getPost('weight') ?? $this->request->getGet('weight'));
        $height = (float) ($this->request->getPost('height') ?? $this->request->getGet('height'));

        if ($weight <= 0.0 || $height <= 0.0) {
            return $this->response->setStatusCode(400)->setJSON([
                'error' => 'Poids et taille doivent etre superieurs a 0.',
            ]);
        }

        $imc = calculate_imc($weight, $height);

        return $this->response->setJSON([
            'imc' => round($imc, 2),
        ]);
    }
}
