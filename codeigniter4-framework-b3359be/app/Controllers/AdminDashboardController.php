<?php

namespace App\Controllers;

use App\Models\ActivityModel;
use App\Models\CodeModel;
use App\Models\RegimeModel;
use App\Models\UserModel;

class AdminDashboardController extends BaseController
{
    public function index()
    {
        $guard = $this->requireAdmin();
        if ($guard) {
            return $guard;
        }

        $userModel = new UserModel();
        $regimeModel = new RegimeModel();
        $activityModel = new ActivityModel();
        $codeModel = new CodeModel();

        $db = db_connect();
        $walletTotal = $db->table('users')->selectSum('wallet')->get()->getRowArray();

        return view('admin/dashboard', [
            'userCount' => $userModel->countAllResults(),
            'regimeCount' => $regimeModel->countAllResults(),
            'activityCount' => $activityModel->countAllResults(),
            'validCodes' => $codeModel->where('is_valid', 1)->countAllResults(),
            'walletTotal' => $walletTotal ? (float) $walletTotal['wallet'] : 0.0,
        ]);
    }
}
