<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\MainMenu;

class RebuildMainMenu extends Controller {

  public function index()  {
    $menu = [// Account
      ['id' => 1, 'name' => 'Register', 'slug' => 'register', 'url' => '/register', 'description' => 'Website Registration', 'icon' => '', 'cssClass' => '', 'cssId' => '', 'onClick' => '', 'userGroup' => 'guest'],
      ['id' => 2, 'name' => 'Login', 'slug' => 'login', 'url' => '/login', 'description' => 'Login to Your Account', 'icon' => '', 'cssClass' => '', 'cssId' => '', 'onClick' => '', 'userGroup' => 'guest'],
      ['id' => 3, 'name' => 'Account', 'slug' => 'account', 'url' => '/profile', 'description' => 'View Your Profile', 'icon' => '', 'cssClass' => '', 'cssId' => '', 'onClick' => '', 'userGroup' => 'users',
        'children' => [
          ['id' => 4, 'name' => 'Logout', 'slug' => 'logout', 'url' => '/logout', 'description' => 'Website Logout', 'icon' => '', 'cssClass' => '', 'cssId' => '', 'onClick' => '', 'userGroup' => 'users'],
          ['id' => 5, 'name' => 'Users', 'slug' => 'users', 'url' => '/users', 'description' => 'Admin: Users', 'icon' => '', 'cssClass' => '', 'cssId' => '', 'onClick' => '', 'userGroup' => 'admin'],
          ['id' => 6, 'name' => 'Groups', 'slug' => 'groups', 'url' => '/groups', 'description' => 'Admin: Groups', 'icon' => '', 'cssClass' => '', 'cssId' => '', 'onClick' => '', 'userGroup' => 'admin',
            'children' => [

            ]
          ]
        ]
      ],
      ['id' => 8, 'name' => 'Misc Admin', 'slug' => 'Misc Admin', 'url' => '#', 'description' => 'Misc Admin Functions', 'icon' => '', 'cssClass' => '', 'cssId' => '', 'onClick' => '', 'userGroup' => 'admin',
        'children' => [
          ['id' => 9, 'name' => 'Rebuild Main Menu', 'slug' => 'rebuild-main-menu', 'url' => '/RebuildMainMenu', 'description' => 'Admin: Rebuild Main Menu', 'icon' => '', 'cssClass' => '', 'cssId' => '', 'onClick' => '', 'userGroup' => 'admin'],
        ]
      ]
      // About Us / Home
    ];


    MainMenu::buildTree($menu);


    // I know the above stuff works... testing more stuff here...

$newChildNode = ['name' => 'Testing', 'slug' => 'testing',
     'url' => '/', 'description' => 'Testing',
     'icon' => '', 'cssClass' => '', 'cssId' => '', 'onClick' => '',
     'userGroup' => 'users'];


// This creates a new Child node to the named parent.
    $GroupNode = MainMenu::where('name', '=', 'Groups')->first();
    $NewKid = MainMenu::create($newChildNode);
    $NewKid->makeChildOf($GroupNode);

    //MainMenu::rebuild();

    //MainMenu::create($newChildNode)->makeChildOf(MainMenu::where('name', '=', 'Account')->first());

    //exit;


    //echo "Something happened...";
    //return MainMenu::all()->toHierarchy();
    //return redirect('users'); //send the admin to the users page... just for testing right now.
    return view('welcome')->with('rawContentData', var_export(MainMenu::all()->toHierarchy(), true));
  }


}
