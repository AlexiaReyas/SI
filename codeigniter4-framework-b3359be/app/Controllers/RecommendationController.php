<?php

namespace App\Controllers;

use App\Models\ActivityModel;
use App\Models\HealthModel;
use App\Models\ObjectiveModel;
use App\Models\RegimeModel;
use App\Models\SettingModel;
use App\Models\UserModel;

class RecommendationController extends BaseController
{
    public function index()
    {
        $guard = $this->requireLogin();
        if ($guard) {
            return $guard;
        }

        $userId = (int) $this->session->get('user_id');
        $health = (new HealthModel())->where('user_id', $userId)->first();
        if (!$health) {
            return redirect()->to('/profile')->with('error', 'Profil incomplet.');
        }

        $imc = (float) $health['imc'];
        $settings = $this->getSettings();
        $goal = $this->decideGoal($userId, $imc, $settings['imc_min'], $settings['imc_max']);

        $regimeModel = new RegimeModel();
        if ($goal === 'gain') {
            $regime = $regimeModel->where('weight_change_kg >', 0)->first();
        } elseif ($goal === 'loss') {
            $regime = $regimeModel->where('weight_change_kg <', 0)->first();
        } else {
            $regime = $regimeModel
                ->where('weight_change_kg >=', -0.5)
                ->where('weight_change_kg <=', 0.5)
                ->first();
        }

        if (!$regime) {
            $regime = $regimeModel->first();
        }

        $activity = (new ActivityModel())->first();

        $user = (new UserModel())->find($userId);
        $price = $regime ? (float) $regime['base_price'] : 0.0;
        $discount = 0.0;
        if ($user && (int) $user['gold'] === 1) {
            $discount = round($price * 0.15, 2);
        }

        return view('recommendations/index', [
            'imc' => $imc,
            'goal' => $goal,
            'regime' => $regime,
            'activity' => $activity,
            'price' => $price,
            'discount' => $discount,
            'finalPrice' => max($price - $discount, 0),
        ]);
    }

    public function exportPdf()
    {
        $guard = $this->requireLogin();
        if ($guard) {
            return $guard;
        }

        $userId = (int) $this->session->get('user_id');
        $health = (new HealthModel())->where('user_id', $userId)->first();
        if (!$health) {
            return redirect()->to('/profile')->with('error', 'Profil incomplet.');
        }

        $imc = (float) $health['imc'];
        $settings = $this->getSettings();
        $goal = $this->decideGoal($userId, $imc, $settings['imc_min'], $settings['imc_max']);

        $regimeModel = new RegimeModel();
        if ($goal === 'gain') {
            $regime = $regimeModel->where('weight_change_kg >', 0)->first();
        } elseif ($goal === 'loss') {
            $regime = $regimeModel->where('weight_change_kg <', 0)->first();
        } else {
            $regime = $regimeModel
                ->where('weight_change_kg >=', -0.5)
                ->where('weight_change_kg <=', 0.5)
                ->first();
        }

        if (!$regime) {
            $regime = $regimeModel->first();
        }

        $activity = (new ActivityModel())->first();

        $user = (new UserModel())->find($userId);
        $price = $regime ? (float) $regime['base_price'] : 0.0;
        $discount = 0.0;
        if ($user && (int) $user['gold'] === 1) {
            $discount = round($price * 0.15, 2);
        }

        $data = [
            'imc' => $imc,
            'goal' => $goal,
            'regime' => $regime,
            'activity' => $activity,
            'price' => $price,
            'discount' => $discount,
            'finalPrice' => max($price - $discount, 0),
        ];

        $html = view('recommendations/pdf', $data);

        if (class_exists('Dompdf\\Dompdf')) {
            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="recommendations.pdf"')
                ->setBody($dompdf->output());
        }

        return $this->response->setBody($html);
    }

    private function decideGoal(int $userId, float $imc, float $imcMin, float $imcMax): string
    {
        $objectives = (new ObjectiveModel())
            ->where('user_id', $userId)
            ->findAll();

        $labels = array_map(static function ($row) {
            return $row['objective'];
        }, $objectives);

        if (in_array('augmenter', $labels, true)) {
            return 'gain';
        }
        if (in_array('reduire', $labels, true)) {
            return 'loss';
        }
        if (in_array('ideal', $labels, true)) {
            return 'maintain';
        }

        if ($imc < $imcMin) {
            return 'gain';
        }
        if ($imc > $imcMax) {
            return 'loss';
        }

        return 'maintain';
    }

    private function getSettings(): array
    {
        $settings = (new SettingModel())->findAll();
        $map = [];
        foreach ($settings as $row) {
            $map[$row['setting_key']] = $row['setting_value'];
        }

        return [
            'imc_min' => isset($map['imc_min_normal']) ? (float) $map['imc_min_normal'] : 18.5,
            'imc_max' => isset($map['imc_max_normal']) ? (float) $map['imc_max_normal'] : 24.9,
        ];
    }
}
