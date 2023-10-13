<?php

namespace App\Interfaces\Patients;

interface PatientsRepositoryInterface{

    public function index();

    public function show($id);

    public function create();

    public function store($request);

    public function edit($id);

    public function update($request);

    public function destroy($request);





}
