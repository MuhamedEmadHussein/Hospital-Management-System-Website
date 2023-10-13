<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSingleServiceRequest;
use App\Interfaces\Services\SingleServicesRepositoryInterface;
use App\Models\Service;
use Illuminate\Http\Request;

class SingleServiceController extends Controller
{
    private $services;
  
    public function __construct(SingleServicesRepositoryInterface $services)
    {
        $this->services = $services;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return $this->services->index();
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
    public function store(StoreSingleServiceRequest $request)
    {
        //
        return $this->services->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSingleServiceRequest $request)
    {
        //
        return $this->services->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        return $this->services->destroy($request);
    }
}
