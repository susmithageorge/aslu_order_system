<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function(Blueprint $table)
        {
         $table->increments('id');
          $table->integer('order_id')->unsigned()->nullable();
          $table->integer('product_id')->unsigned()->nullable();
          $table->string('name', 255);
          $table->decimal('quantity', 11, 2);
          $table->decimal('price', 11, 2);
          $table->text('remarks');
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
        Schema::drop('items');
    }
}
