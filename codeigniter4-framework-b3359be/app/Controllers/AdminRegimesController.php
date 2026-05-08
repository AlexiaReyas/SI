<?php

namespace App\Controllers;

use App\Models\RegimeModel;

class AdminRegimesController extends BaseController
{
    public function index()
    {
        $guard = $this->requireAdmin();
        if ($guard) {
            return $guard;
        }

        $regimes = (new RegimeModel())->findAll();
        return view('admin/regimes/index', ['regimes' => $regimes]);
    }

    public function create()
    {
        $guard = $this->requireAdmin();
        if ($guard) {
            return $guard;
        }

        return view('admin/regimes/create');
    }

    public function store()
    {
        $guard = $this->requireAdmin();
        if ($guard) {
            return $guard;
        }

        $data = $this->extractData();
        if (!$data) {
            return redirect()->to('/admin/regimes/create')->with('error', 'Tous les champs sont obligatoires.');
        }

        (new RegimeModel())->insert($data);
        return redirect()->to('/admin/regimes')->with('success', 'Regime cree.');
    }

    public function edit(int $id)
    {
        $guard = $this->requireAdmin();
        if ($guard) {
            return $guard;
        }

        $regime = (new RegimeModel())->find($id);
        return view('admin/regimes/edit', ['regime' => $regime]);
    }

    public function update(int $id)
    {
        $guard = $this->requireAdmin();
        if ($guard) {
            return $guard;
        }

        $data = $this->extractData();
        if (!$data) {
            return redirect()->to('/admin/regimes/' . $id . '/edit')->with('error', 'Tous les champs sont obligatoires.');
        }

        (new RegimeModel())->update($id, $data);
        return redirect()->to('/admin/regimes')->with('success', 'Regime mis a jour.');
    }

    public function delete(int $id)
    {
        $guard = $this->requireAdmin();
        if ($guard) {
            return $guard;
        }

        (new RegimeModel())->delete($id);
        return redirect()->to('/admin/regimes')->with('success', 'Regime supprime.');
    }

    private function extractData(): ?array
    {
        $name = trim((string) $this->request->getPost('name'));
        $description = trim((string) $this->request->getPost('description'));
        $basePrice = (float) $this->request->getPost('base_price');
        $duration = (int) $this->request->getPost('duration_days');
        $weightChange = (float) $this->request->getPost('weight_change_kg');
        $pctMeat = (int) $this->request->getPost('pct_meat');
        $pctFish = (int) $this->request->getPost('pct_fish');
        $pctPoultry = (int) $this->request->getPost('pct_poultry');

        if ($name === '' || $description === '' || $basePrice <= 0 || $duration <= 0) {
            return null;
        }

        return [
            'name' => $name,
            'description' => $description,
            'base_price' => $basePrice,
            'duration_days' => $duration,
            'weight_change_kg' => $weightChange,
            'pct_meat' => $pctMeat,
            'pct_fish' => $pctFish,
            'pct_poultry' => $pctPoultry,
        ];
    }
}
