<?php

namespace App\Interfaces\LaboratoriesEmployee\Invoices;

interface LabEmployeeInvoicesRepositoryInterface{
    public function index();
    public function completedInvoices();
    public function edit($id);
    public function update($request, $id);
    public function show($id);

    public function viewLaboratories($id);
    public function destroy($id);


}
