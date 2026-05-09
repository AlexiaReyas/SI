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

        $weight = isset($health['weight_kg']) ? (float) $health['weight_kg'] : 0.0;
        $height = isset($health['height_cm']) ? (float) $health['height_cm'] : 0.0;
        $imc = (isset($health['imc']) && (float) $health['imc'] > 0)
            ? (float) $health['imc']
            : (($weight > 0.0 && $height > 0.0) ? round($weight / (($height / 100) ** 2), 2) : 0.0);

        $settings = $this->getSettings();
        $goal = $this->decideGoal($userId, $imc, $settings['imc_min'], $settings['imc_max']);

        $regimes = $this->getRegimeSuggestions($goal);
        $activites = $this->getActivitySuggestions($goal, $imc);

        $user = (new UserModel())->find($userId);
        $price = $regimes !== [] ? (float) ($regimes[0]['base_price'] ?? 0.0) : 0.0;
        $discount = 0.0;
        if ($user && (int) $user['gold'] === 1) {
            $discount = round($price * 0.15, 2);
        }

        return view('recommendations/index', [
            'user' => [
                'imc' => $imc,
                'objectif_label' => $this->goalLabel($goal),
            ],
            'regimes' => $regimes,
            'activites' => $activites,
            'price' => $price,
            'discount' => $discount,
            'finalPrice' => max($price - $discount, 0),
        ]);
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

    private function getRegimeSuggestions(string $goal): array
    {
        $model = new RegimeModel();

        switch ($goal) {
            case 'gain':
                $rows = $model->where('weight_change_kg >', 0)
                    ->orderBy('weight_change_kg', 'DESC')
                    ->findAll(3);
                break;
            case 'loss':
                $rows = $model->where('weight_change_kg <', 0)
                    ->orderBy('weight_change_kg', 'ASC')
                    ->findAll(3);
                break;
            default:
                $rows = $model->where('weight_change_kg >=', -0.5)
                    ->where('weight_change_kg <=', 0.5)
                    ->orderBy('base_price', 'ASC')
                    ->findAll(3);
                break;
        }

        if ($rows === []) {
            $rows = $model->orderBy('base_price', 'ASC')->findAll(3);
        }

        return array_map(static function (array $row): array {
            return [
                'nom' => $row['name'],
                'description' => $row['description'],
                'base_price' => (float) $row['base_price'],
                'viande_pct' => (float) $row['pct_meat'],
                'poisson_pct' => (float) $row['pct_fish'],
                'volaille_pct' => (float) $row['pct_poultry'],
            ];
        }, $rows);
    }

    private function getActivitySuggestions(string $goal, float $imc): array
    {
        $model = new ActivityModel();

        if ($goal === 'loss' || $imc >= 25) {
            $rows = $model->orderBy('duration_minutes', 'DESC')->findAll(3);
        } elseif ($goal === 'gain') {
            $rows = $model->orderBy('duration_minutes', 'ASC')->findAll(3);
        } else {
            $rows = $model->orderBy('name', 'ASC')->findAll(3);
        }

        return array_map(static function (array $row): array {
            return [
                'nom' => $row['name'],
                'description' => $row['description'],
                'duration_minutes' => (int) $row['duration_minutes'],
            ];
        }, $rows);
    }

    private function goalLabel(string $goal): string
    {
        return match ($goal) {
            'gain' => 'Augmenter',
            'loss' => 'Réduire',
            default => 'Atteindre l\'IMC idéal',
        };
    }
}
