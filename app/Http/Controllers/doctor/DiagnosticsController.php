<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\doctor_dashboard\DiagnosticRepositoryInterface;
use Illuminate\Http\Request;

class DiagnosticsController extends Controller
{
    private $diagnostics;
  
    public function __construct(DiagnosticRepositoryInterface $diagnostics)
    {
        $this->diagnostics = $diagnostics;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        return $this->diagnostics->store($request);
    }

    public function addReview(Request $request)
    {
        return $this->diagnostics->addReview($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->diagnostics->show($id);
        
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
