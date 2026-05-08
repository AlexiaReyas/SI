<?php

namespace App\Controllers;

use App\Models\ObjectiveModel;

class ObjectiveController extends BaseController
{
    public function index()
    {
        $guard = $this->requireLogin();
        if ($guard) {
            return $guard;
        }

        $userId = (int) $this->session->get('user_id');
        $existing = (new ObjectiveModel())->where('user_id', $userId)->findAll();
        $selected = array_map(static function ($row) {
            return $row['objective'];
        }, $existing);

        return view('profile/objectives', [
            'selected' => $selected,
        ]);
    }

    public function save()
    {
        $guard = $this->requireLogin();
        if ($guard) {
            return $guard;
        }

        $objectives = (array) $this->request->getPost('objectives');
        $objectives = array_values(array_filter($objectives));

        if (count($objectives) === 0 || count($objectives) > 3) {
            return redirect()->to('/objectives')->with('error', 'Choisissez 1 a 3 objectifs.');
        }

        $userId = (int) $this->session->get('user_id');
        $model = new ObjectiveModel();
        $model->where('user_id', $userId)->delete();

        foreach ($objectives as $objective) {
            $model->insert([
                'user_id' => $userId,
                'objective' => $objective,
            ]);
        }

        return redirect()->to('/recommendations')->with('success', 'Objectifs enregistres.');
    }
}
