<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDoctorsRequest;
use App\Interfaces\Doctors\DoctorsRepositoryInterface;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    private $doctors;
  
    public function __construct(DoctorsRepositoryInterface $doctors)
    {
        $this->doctors = $doctors;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    return $this->doctors->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return $this->doctors->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDoctorsRequest $request)
    {
        //
        return $this->doctors->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        return $this->doctors->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDoctorsRequest $request)
    {
        //
        return $this->doctors->update($request);
    }

    public function update_password(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ],[
        'password.required' => trans('Dashboard/validation.required'),
        'password.min' => trans('Dashboard/validation.min.numeric'),
        'password.confirmed' => trans('Dashboard/validation.confirmed'),
        'password_confirmation.required' => trans('Dashboard/validation.required'),
        'password_confirmation.min' => trans('Dashboard/validation.min.numeric'),
        ]);

        return $this->doctors->update_password($request);
    }

    public function update_status(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|in:0,1',
        ],[
            'status.required' => trans('Dashboard/validation.required'),
            'status.in' => trans('Dashboard/validation.in'),
        ]);
        return $this->doctors->update_status($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        return $this->doctors->destroy($request);
    }
}
