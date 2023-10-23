<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\RayEmployee\RayEmployeeRepositoryInterface;
use Illuminate\Http\Request;

class RayEmployeeController extends Controller
{
    private $ray_employee;
  
    public function __construct(RayEmployeeRepositoryInterface $ray_employee)
    {
        $this->ray_employee = $ray_employee;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return $this->ray_employee->index();
    }

    public function showInvoices(){
        return $this->ray_employee->showInvoices();
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
        return $this->ray_employee->store($request);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editRay($id)
    {
        //
        return $this->ray_employee->editRay($id);
    }

    public function addRayDiagnosis(Request $request,$id){

        return $this->ray_employee->addRayDiagnosis($request,$id);
        
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        return $this->ray_employee->update($request,$id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        return $this->ray_employee->destroy($id);

    }
}
