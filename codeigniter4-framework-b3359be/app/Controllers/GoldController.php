<?php

namespace App\Controllers;

use App\Models\PaymentModel;
use App\Models\SettingModel;
use App\Models\UserModel;

class GoldController extends BaseController
{
    public function index()
    {
        $guard = $this->requireLogin();
        if ($guard) {
            return $guard;
        }

        $price = $this->getGoldPrice();
        $user = (new UserModel())->find((int) $this->session->get('user_id'));

        return view('gold/index', [
            'price' => $price,
            'user' => $user,
        ]);
    }

    public function buy()
    {
        $guard = $this->requireLogin();
        if ($guard) {
            return $guard;
        }

        $price = $this->getGoldPrice();
        $userId = (int) $this->session->get('user_id');
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        if ((int) $user['gold'] === 1) {
            return redirect()->to('/gold')->with('success', 'Option Gold deja activee.');
        }

        if ((float) $user['wallet'] < $price) {
            return redirect()->to('/gold')->with('error', 'Solde insuffisant.');
        }

        $userModel->update($userId, [
            'gold' => 1,
            'wallet' => (float) $user['wallet'] - $price,
        ]);

        (new PaymentModel())->insert([
            'user_id' => $userId,
            'amount' => $price,
            'type' => 'gold',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $this->session->set('gold', 1);
        return redirect()->to('/gold')->with('success', 'Option Gold activee.');
    }

    private function getGoldPrice(): float
    {
        $setting = (new SettingModel())->where('setting_key', 'gold_price')->first();
        return $setting ? (float) $setting['setting_value'] : 200.00;
    }
}
