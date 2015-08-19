<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
      	{
          $table->increments('id');
          $table->string('username', 100);
          $table->string('email', 255);
          $table->string('password', 255);
          $table->tinyInteger('user_type');
          $table->string('name', 64);
          $table->text('address');
          $table->text('bio');
		  $table->string('remember_token', 100)->nullable();
          $table->timestamps();
      });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
