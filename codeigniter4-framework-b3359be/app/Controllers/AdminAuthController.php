<?php

namespace App\Controllers;

use App\Models\UserModel;

class AdminAuthController extends BaseController
{
    public function login()
    {
        if ($this->session->get('user_id') && $this->session->get('is_admin')) {
            return redirect()->to('/admin');
        }

        return view('admin/login');
    }

    public function attempt()
    {
        $email = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');

        if ($email === '' || $password === '') {
            return redirect()->to('/admin/login')->with('error', 'Email et mot de passe obligatoires.');
        }

        $user = (new UserModel())->where('email', $email)->first();
        if (!$user || (int) $user['is_admin'] !== 1) {
            return redirect()->to('/admin/login')->with('error', 'Acces refuse.');
        }

        if (!password_verify($password, $user['password_hash'])) {
            return redirect()->to('/admin/login')->with('error', 'Identifiants invalides.');
        }

        $this->session->set([
            'user_id' => $user['id'],
            'user_name' => $user['name'],
            'is_admin' => 1,
            'gold' => (int) $user['gold'],
        ]);

        return redirect()->to('/admin');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/admin/login');
    }
}
