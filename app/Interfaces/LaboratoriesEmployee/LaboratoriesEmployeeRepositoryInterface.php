<?php

namespace App\Interfaces\LaboratoriesEmployee;

interface LaboratoriesEmployeeRepositoryInterface{
    public function index();

    public function store($request);

    public function update($request, $id);

    public function destroy($id);
}
