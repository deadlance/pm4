<?php
namespace App\Http\ViewComposers;
use Illuminate\Contracts\View\View;
use Baum\Node;
use Session;
use Sentry;
use \App\MainMenu;
class MainMenuComposer {
  /**
   * @var bool
   */
  private $guest = true;
  /**
   * @param View $view
   *
   * This is the method that outputs the mainMenu for our website.
   * Menu will be output as a nested set array.
   *
   */
  public function compose(View $view) {
    // First we have to determine if the user is a guest or a logged in user.
    if(Sentry::check()) {
      $this->guest = false;
      $user = Sentry::getUser();
    }
    else {
      $user = '';
      $this->guest = true;
    }
    // Next we get the menu contents and start rendering the menu.
    $menu = MainMenu::all()->toHierarchy();
    $html = "<ul class='nav navbar-nav'>";
    foreach($menu as $node) {
      $html .= $this->checkNode($node, $user);
    }
    $html .= "</ul>";
    $view->with('MainMenu', $html);
  }
  /**
   * @param $node
   * @param $user
   * @return string
   *
   * This function checks the permissions of each menu node to see if it's going to be needed to
   * be output to the user or not. If so, it will call the renderNode function.
   *
   */
  private function checkNode($node, $user) {
    if(($node->userGroup == 'guest' && $this->guest == true)) {
      return $this->renderNode($node, $user);
    }
    elseif($this->guest == false && $user->hasAnyAccess(array($node->userGroup))) {
      return $this->renderNode($node, $user);
    }
    else {
      return '';
    }
  } // End of checkNode
  /**
   * @param $node
   * @param $user
   * @return string
   *
   * This function actually does the rendering of each menu node.
   * It is called by the checkNode function only.
   *
   */
  private function renderNode($node, $user) {
    $html = ''; // Just make this empty to start with.
    if ($node->isLeaf()) {
      return '<li><a href="' . $node->url . '" title="' . $node->description . '" class="' . $node->cssClass . '" id= "' . $node->cssId . '">' . $node->name . '</a></li>';
    }
    else {
      $html = '<li><a href="' . $node->url . '" title="' . $node->description . '" class="' . $node->cssClass . '" id= "' . $node->cssId . '">' . $node->name . '</a>';
      $html .= '<ul class="dropdown-menu">';
      foreach ($node->children as $child) {
        $html .= $this->checkNode($child, $user);
      }
      $html .= '</ul>';
      $html .= '</li>';
    }
    return $html;
  } // End of renderNode
}