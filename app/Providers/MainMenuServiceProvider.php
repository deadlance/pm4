<?php
namespace App\Providers;
use View;
use Baum\Node;
use Session;
use Sentry;
use Illuminate\Support\ServiceProvider;
class MainMenuServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap the application services.
   *
   * @return void
   */
  public function boot()
  {
    View::composer('*', 'App\Http\ViewComposers\MainMenuComposer');
  }
  /**
   * Register the application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }
}