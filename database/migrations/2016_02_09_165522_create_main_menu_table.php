<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainMenuTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('main_menus', function(Blueprint $table) {

      /*
       * Columns needed for the Baum's Nested Set.
       */
      $table->increments('id');
      $table->integer('parent_id')->nullable()->index();
      $table->integer('lft')->nullable()->index();
      $table->integer('rgt')->nullable()->index();
      $table->integer('depth')->nullable();

      /*
       * Columns needed for our MainMenu
       */
      $table->string('name')->nullable();
      $table->string('slug')->nullable();
      $table->string('url')->nullable();
      $table->string('description')->nullable();
      $table->string('icon')->nullable();
      $table->string('cssClass')->nullable();
      $table->string('cssId')->nullable();
      $table->string('onClick')->nullable();
      $table->string('userGroup')->nullable();

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('main_menus');
  }

}
