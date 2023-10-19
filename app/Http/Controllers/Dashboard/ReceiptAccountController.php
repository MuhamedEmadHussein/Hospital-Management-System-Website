<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Finance\ReceiptRepositoryInterface;
use Illuminate\Http\Request;

class ReceiptAccountController extends Controller
{
    private $receipts;
  
    public function __construct(ReceiptRepositoryInterface $receipts)
    {
        $this->receipts = $receipts;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return $this->receipts->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return $this->receipts->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        return $this->receipts->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        return $this->receipts->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        return $this->receipts->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        return $this->receipts->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        return $this->receipts->destroy($request);
    }
}
