<?php

namespace App\Controllers;

use App\Models\CodeModel;
use App\Models\PaymentModel;
use App\Models\UserModel;

class WalletController extends BaseController
{
    public function index()
    {
        $guard = $this->requireLogin();
        if ($guard) {
            return $guard;
        }

        $userId = (int) $this->session->get('user_id');
        $user = (new UserModel())->find($userId);

        return view('wallet/index', [
            'user' => $user,
        ]);
    }

    public function applyCode()
    {
        $guard = $this->requireLogin();
        if ($guard) {
            return $guard;
        }

        $codeValue = trim((string) $this->request->getPost('code'));
        if ($codeValue === '') {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Code obligatoire.',
                ]);
            }

            return redirect()->to('/wallet')->with('error', 'Code obligatoire.');
        }

        $codeModel = new CodeModel();
        $code = $codeModel->where('code', $codeValue)->first();
        if (!$code || (int) $code['is_valid'] !== 1) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Code invalide ou deja utilise.',
                ]);
            }

            return redirect()->to('/wallet')->with('error', 'Code invalide ou deja utilise.');
        }

        $userId = (int) $this->session->get('user_id');
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        $newWallet = (float) $user['wallet'] + (float) $code['amount'];
        $userModel->update($userId, ['wallet' => $newWallet]);

        $codeModel->update($code['id'], [
            'is_valid' => 0,
            'used_by' => $userId,
            'used_at' => date('Y-m-d H:i:s'),
        ]);

        (new PaymentModel())->insert([
            'user_id' => $userId,
            'amount' => (float) $code['amount'],
            'type' => 'wallet',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Code applique avec succes.',
                'balance' => $newWallet,
            ]);
        }

        return redirect()->to('/wallet')->with('success', 'Code applique.');
    }
}
