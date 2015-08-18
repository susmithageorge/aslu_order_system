<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableManufacturers extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manufacturers', function(Blueprint $table)
        {
          $table->increments('id');
          $table->integer('user_id')->unsigned()->nullable();
          $table->integer('itemmaster_id')->unsigned()->nullable();
          $table->string('name', 255);
          $table->text('description');
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
        Schema::drop('manufacturers');
    }
}
