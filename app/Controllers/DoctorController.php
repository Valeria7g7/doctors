<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\DoctorService;
use CodeIgniter\HTTP\ResponseInterface;


class DoctorController extends BaseController
{
    private DoctorService $service;
    public function __construct()
    {
        $this->service = new DoctorService();
    }
    public function index()
    {
        $value = $this->request->getGet('query');
        $doctors = null;
        if (!$value) $doctors = $this->service->getAll();
        if ($value) $doctors = $this->service->findDoctor($value);
        return view('doctor/index', ['doctors' => $doctors]);
    }
    public function create()
    {
        //dd('Entró al create');
        return view('doctor/form', ['mode' => 'CREATE', 'doctor' => null]);
    }
    public function edit($id)
    {
        $doctor = $this->service->findById($id);
        return view('doctor/form', ['mode' => 'UPDATE', 'doctor' => $doctor]);
    }

    public function store()
    {
        $rules = [
            'full_name' => 'required|min_length[10]',
            'specialty' => 'required',
            'professional_license' => 'required|min_length[7]|max_length[8]'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        try {
            $data = $this->request->getPost();
            $medico = $this->service->create($data);
            return redirect()->to(site_url('doctor/search'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
    public function update($id)
    {
        try {
            $data = $this->request->getPost();
            $this->service->update($id, $data);
            return redirect()->to(site_url('doctor/search'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
    public function delete($id)
    {
        try {
            $this->service->delete($id);
            return redirect()->to(site_url('doctor/search'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
}
