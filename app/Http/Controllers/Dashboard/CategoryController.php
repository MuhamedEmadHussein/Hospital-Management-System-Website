<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Categories\CategoriesRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    private $categories;
  
    public function __construct(CategoriesRepositoryInterface $categories)
    {
        $this->categories = $categories;
    }
 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return $this->categories->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        return $this->categories->store($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        return $this->categories->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
       return $this->categories->destroy($request);
    }

    public function show($id)
    {
        //
        return $this->categories->show($id);
    }
}
