<?php

namespace App\Controllers;

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

        // Placeholder auth: replace with model check later.
        session()->set([
            'user_email' => $email,
            'is_logged_in' => true,
        ]);

        return redirect()->to('/dashboard')->with('success', 'Connexion reussie.');
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

        session()->set([
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

        // Placeholder user creation: replace with model insert later.
        session()->set([
            'user_email' => (string) session()->get('reg_email'),
            'is_logged_in' => true,
        ]);
        session()->remove(['reg_name', 'reg_email']);

        return redirect()->to('/dashboard')->with('success', 'Inscription terminee.');
    }

    public function logout()
    {
        session()->destroy();

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
