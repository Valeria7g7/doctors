<?php

namespace App\Services;

use App\Models\Doctor;

class DoctorService

{

    private Doctor $medico;
    public function __construct()
    {
        $this->medico = new Doctor();
    }

    public function create(array $data)
    {
        $exists = $this->medico->where('professional_license', $data['professional_license'])
            ->first();

        if ($exists) {
            throw new \Exception('Ya existe un médico con esa cédula profesional');
        }
        return $this->medico->insert($data);
    }
    public function update($id, array $data)
    {
        $medic = $this->medico->find($id);
        if (!$medic) throw new \Exception("Medico no encontrado", 404);
        return $this->medico->update($id, $data);
    }
    public function delete($id)
    {
        $medic = $this->medico->find($id);
        if (!$medic) throw new \Exception("Medico no encontrado, no es posible eliminarse", 404);
        return $this->medico->delete($id);
    }
    public function getAll()
    {
        return $this->medico->findAll();
    }
    public function findById($id)
    {
        return $this->medico->find($id);
    }
    public function findDoctor($value)
    {
        $doctors = $this->medico->groupStart()
            ->where('id', $value)->orWhere('professional_license', $value)
            ->orWhere('specialty', $value)->orWhere('full_name', $value)->groupEnd()->findAll();
        if (!$doctors || $doctors == null) return [];
        return $doctors;
    }
}
