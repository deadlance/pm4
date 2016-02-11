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



  Route::get('/', array('as' => 'home', function () {
      return view('welcome');
  }));

  Route::get('/categories', function() {
    return view('categories.index');
  });


  /*
   *  These routes are for Admins only...
   */
    Route::group(['middleware' => ['sentry.member:Admins']], function () {
      // This rebuilds the main menu.
      Route::get('RebuildMainMenu', 'RebuildMainMenu@index');
      //Route::get('/MenuBuilder', 'MenuBuilder@index');

    }); // End of Admin Only Routes

});