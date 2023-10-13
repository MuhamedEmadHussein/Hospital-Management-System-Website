<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientsRequest;
use App\Interfaces\Patients\PatientsRepositoryInterface;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    private $patients;
  
    public function __construct(PatientsRepositoryInterface $patients)
    {
        $this->patients = $patients;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return $this->patients->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return $this->patients->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientsRequest $request)
    {
        //
        return $this->patients->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        return $this->patients->show($id);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        return $this->patients->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePatientsRequest $request)
    {
        //
        return $this->patients->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        return $this->patients->destroy($request);
    }
}
