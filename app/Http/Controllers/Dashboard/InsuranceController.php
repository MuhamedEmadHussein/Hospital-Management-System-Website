<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInsurancesRequest;
use App\Interfaces\Insurances\InsurancesRepositoryInterface;
use App\Models\Insurance;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    private $insurances;

    public function __construct(InsurancesRepositoryInterface $insurances)
    {
        $this->insurances = $insurances;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return $this->insurances->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return $this->insurances->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInsurancesRequest $request)
    {
        //
        return $this->insurances->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Insurance $insurance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        return $this->insurances->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreInsurancesRequest $request)
    {
        //
        return $this->insurances->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        return $this->insurances->destroy($request);
    }
}
