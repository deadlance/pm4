<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
  /*
   * API Routes
   */
  Route::resource('api/categories', 'CategoriesController');

  Route::resource('api/products', 'ProductsController');


  Route::get('/', array('as' => 'home', function () {
      return view('welcome');
  }));

  Route::get('/categories', function() {
    return view('categories.index');
  });

  // Show Products for the category id
  Route::get('/categories/{category_id}', 'CategoriesController@getProducts');
  Route::get('/category/products/{category_id}', 'ProductsController@categoryListing');



  /*
   *  These routes are for Admins only...
   */
    Route::group(['middleware' => ['sentry.member:Admins']], function () {
      // This rebuilds the main menu.
      Route::get('RebuildMainMenu', 'RebuildMainMenu@index');
      //Route::get('/MenuBuilder', 'MenuBuilder@index');

    }); // End of Admin Only Routes

});