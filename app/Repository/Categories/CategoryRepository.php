<?php

namespace App\Repository\Categories;

use App\Interfaces\Categories\CategoriesRepositoryInterface;
use App\Models\Category;
use App\Models\Doctor;

class CategoryRepository implements CategoriesRepositoryInterface {

    public function index(){
        $categories = Category::all();
        return view('Dashboard.Categories.index',compact('categories'));
    }

    public function store($request){
        $request->validate([
            'name' => 'required',
        ]);
        
        Category::create([
            'name' => $request->input('name'),
        ]);

        session()->flash('add');

        return redirect()->route('categories.index');
    }
    public function update($request){
        $request->validate([
            'name' => 'required',
        ]);

        $category = Category::findOrFail($request->id);
        $category->update([
            'name' => $request->name,
        ]);

        session()->flash('edit');

        return redirect()->route('categories.index');
    }

    public function destroy($request){
        $category = Category::findOrFail($request->id);
        $category->delete();

        session()->flash('delete');

        return redirect()->route('categories.index');
    }

    public function show($id){
        $doctors = Doctor::where('category_id',$id)->get();

        //Another Way :
            // $doctors = Category::findOrFail($id)->doctors;

        return view('Dashboard.Doctors.index',compact('doctors'));

    }    

}
