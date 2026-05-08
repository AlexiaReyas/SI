<?php

namespace App\Controllers;

use App\Models\CodeModel;

class AdminCodesController extends BaseController
{
    public function index()
    {
        $guard = $this->requireAdmin();
        if ($guard) {
            return $guard;
        }

        $codes = (new CodeModel())->orderBy('id', 'DESC')->findAll();
        return view('admin/codes/index', ['codes' => $codes]);
    }

    public function create()
    {
        $guard = $this->requireAdmin();
        if ($guard) {
            return $guard;
        }

        return view('admin/codes/create');
    }

    public function store()
    {
        $guard = $this->requireAdmin();
        if ($guard) {
            return $guard;
        }

        $codeValue = trim((string) $this->request->getPost('code'));
        $amount = (float) $this->request->getPost('amount');

        if ($codeValue === '' || $amount <= 0) {
            return redirect()->to('/admin/codes/create')->with('error', 'Code et montant obligatoires.');
        }

        (new CodeModel())->insert([
            'code' => $codeValue,
            'amount' => $amount,
            'is_valid' => 1,
        ]);

        return redirect()->to('/admin/codes')->with('success', 'Code cree.');
    }

    public function toggle(int $id)
    {
        $guard = $this->requireAdmin();
        if ($guard) {
            return $guard;
        }

        $model = new CodeModel();
        $code = $model->find($id);
        if ($code) {
            $model->update($id, ['is_valid' => $code['is_valid'] ? 0 : 1]);
        }

        return redirect()->to('/admin/codes');
    }
}
