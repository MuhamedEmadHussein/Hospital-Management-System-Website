<?php


namespace App\Interfaces\Categories;

interface CategoriesRepositoryInterface
{
   public function index();

   public function store($request);

   public function update($request);

   public function destroy($request);

   public function show($id);
}
