<?php

namespace App\Http\Controllers\LabEmployee;

use App\Http\Controllers\Controller;
use App\Interfaces\LaboratoriesEmployee\Invoices\LabEmployeeInvoicesRepositoryInterface;
use Illuminate\Http\Request;

class LabInvoicesController extends Controller
{
    private $invoices;
  
    public function __construct(LabEmployeeInvoicesRepositoryInterface $invoices)
    {
        $this->invoices = $invoices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return $this->invoices->index();
    }

    public function completedInvoices(){

        return $this->invoices->completedInvoices();

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        return $this->invoices->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        return $this->invoices->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        return $this->invoices->update($request, $id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        return $this->invoices->destroy($id);
    }
    public function viewLaboratories($id){
        
        return $this->invoices->viewLaboratories($id);
    }
}
