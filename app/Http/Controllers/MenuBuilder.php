<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\MainMenu;


class MenuBuilder extends Controller {

  public function index() {
    return view('menubuilder.viewmenu')->with('menuData', MainMenu::all());
  }


}
