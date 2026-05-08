<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        if ($this->session->get('user_id')) {
            return redirect()->to('/profile');
        }

        return view('auth/login');
    }

    public function attempt()
    {
        $email = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');

        if ($email === '' || $password === '') {
            return redirect()->to('/login')->with('error', 'Email et mot de passe obligatoires.');
        }

        $user = (new UserModel())->where('email', $email)->first();
        if (!$user || !password_verify($password, $user['password_hash'])) {
            return redirect()->to('/login')->with('error', 'Identifiants invalides.');
        }

        $this->session->set([
            'user_id' => $user['id'],
            'user_name' => $user['name'],
            'is_admin' => (int) $user['is_admin'],
            'gold' => (int) $user['gold'],
        ]);

        if ((int) $user['is_admin'] === 1) {
            return redirect()->to('/admin');
        }

        return redirect()->to('/profile');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
