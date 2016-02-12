<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;
use App\Product;

class CategoriesController extends Controller
{
  /**
   * Returns all the root categories.
   *
   * @return \Illuminate\Database\Eloquent\Collection|static[]
   */
  public function index() {
    return Category::where('parent', '=', null)->get();
  }

  /**
   * Returns the subcategories for the submitted category.
   * IE - if $id = 1, this will return all of category 1's subcategories.
   *
   * @param $id
   * @return mixed
   */
  public function show($id) {
    return Category::where('parent', '=', $id)->get();
  }

  public function create(){

  }

  public function store() {

  }

  public function edit() {

  }

  public function update() {

  }

  public function destroy() {

  }

  public function getProducts($category_id)
  {
    return Category::find($category_id)->products;
  }

}
