<?php

namespace App\Controllers;

use App\Models\ActivityModel;

class AdminActivitiesController extends BaseController
{
    public function index()
    {
        $guard = $this->requireAdmin();
        if ($guard) {
            return $guard;
        }

        $activities = (new ActivityModel())->findAll();
        return view('admin/activities/index', ['activities' => $activities]);
    }

    public function create()
    {
        $guard = $this->requireAdmin();
        if ($guard) {
            return $guard;
        }

        return view('admin/activities/create');
    }

    public function store()
    {
        $guard = $this->requireAdmin();
        if ($guard) {
            return $guard;
        }

        $data = $this->extractData();
        if (!$data) {
            return redirect()->to('/admin/activities/create')->with('error', 'Tous les champs sont obligatoires.');
        }

        (new ActivityModel())->insert($data);
        return redirect()->to('/admin/activities')->with('success', 'Activite creee.');
    }

    public function edit(int $id)
    {
        $guard = $this->requireAdmin();
        if ($guard) {
            return $guard;
        }

        $activity = (new ActivityModel())->find($id);
        return view('admin/activities/edit', ['activity' => $activity]);
    }

    public function update(int $id)
    {
        $guard = $this->requireAdmin();
        if ($guard) {
            return $guard;
        }

        $data = $this->extractData();
        if (!$data) {
            return redirect()->to('/admin/activities/' . $id . '/edit')->with('error', 'Tous les champs sont obligatoires.');
        }

        (new ActivityModel())->update($id, $data);
        return redirect()->to('/admin/activities')->with('success', 'Activite mise a jour.');
    }

    public function delete(int $id)
    {
        $guard = $this->requireAdmin();
        if ($guard) {
            return $guard;
        }

        (new ActivityModel())->delete($id);
        return redirect()->to('/admin/activities')->with('success', 'Activite supprimee.');
    }

    private function extractData(): ?array
    {
        $name = trim((string) $this->request->getPost('name'));
        $description = trim((string) $this->request->getPost('description'));
        $duration = (int) $this->request->getPost('duration_minutes');

        if ($name === '' || $description === '' || $duration <= 0) {
            return null;
        }

        return [
            'name' => $name,
            'description' => $description,
            'duration_minutes' => $duration,
        ];
    }
}
