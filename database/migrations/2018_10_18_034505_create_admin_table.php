<?php

use App\Admin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('admins', function (Blueprint $table) {
      $table->increments('id');
      $table->string('username');
      $table->string('password');
      $table->string('remember_token')->nullable();
      $table->timestamps();
    });

    Admin::create(['username' => 'rnd', 'password' => 'ueccssrnd']);
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('admins');
  }
}
