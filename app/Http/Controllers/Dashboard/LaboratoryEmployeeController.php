<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\LaboratoriesEmployee\LaboratoriesEmployeeRepositoryInterface;
use Illuminate\Http\Request;

class LaboratoryEmployeeController extends Controller
{
    private $lab_employee;

    public function __construct(LaboratoriesEmployeeRepositoryInterface $lab_employee)
    {
        $this->lab_employee = $lab_employee;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return $this->lab_employee->index();
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
        return $this->lab_employee->store($request);

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        return $this->lab_employee->update($request, $id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        return $this->lab_employee->destroy($id);
    
    }
}
