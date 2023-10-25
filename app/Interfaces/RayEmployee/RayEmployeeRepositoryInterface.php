<?php

namespace App\Interfaces\RayEmployee;

interface RayEmployeeRepositoryInterface{
    public function index();
    public function showInvoices();
    public function showCompletedInvoices();
    public function store($request);

    public function addRayDiagnosis($request,$id);
    public function editRay($id);
    public function update($request,$id);
    public function destroy($id);  
    public function show($id); 
    public function viewRays($id); 

    
}