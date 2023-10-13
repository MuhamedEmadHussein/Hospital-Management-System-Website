<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAmbulanceRequest;
use App\Interfaces\Ambulances\AmbulancesRepositoryInterface;
use App\Models\Ambulance;
use Illuminate\Http\Request;

class AmbulanceController extends Controller
{

    private $ambulances;

    public function __construct(AmbulancesRepositoryInterface $ambulances)
    {
        $this->ambulances = $ambulances;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return $this->ambulances->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return $this->ambulances->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAmbulanceRequest $request)
    {
        //
        return $this->ambulances->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ambulance $ambulance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        return $this->ambulances->edit($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAmbulanceRequest $request)
    {
        //
        return $this->ambulances->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        return $this->ambulances->destroy($request);
    }
}
