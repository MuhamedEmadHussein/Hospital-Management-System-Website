<?php

namespace App\Interfaces\Services;
interface SingleServicesRepositoryInterface{

    public function index();
    public function store($request);

    public function update($request);
 
    public function destroy($request);

}
