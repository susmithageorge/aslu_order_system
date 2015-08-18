<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDealers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dealers', function(Blueprint $table)
        {
          $table->increments('id');
          $table->integer('user_id')->unsigned()->nullable();
          $table->integer('party_master_id')->unsigned()->nullable();
          $table->string('name', 255);
          $table->string('address', 255);
          $table->string('city', 255);
          $table->string('email', 255);
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
        Schema::drop('dealers');
    }
}
