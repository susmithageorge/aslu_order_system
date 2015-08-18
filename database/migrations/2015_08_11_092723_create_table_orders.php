<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function(Blueprint $table)
        {
          $table->increments('id');
          $table->integer('user_id')->unsigned()->nullable();
          $table->integer('dealer_id')->unsigned()->nullable();
          $table->integer('manufacturer_id')->unsigned()->nullable();
          $table->string('name', 255);
          $table->string('dealer_name', 255);
          $table->string('manufacturer_name', 255);
          $table->text('description');
          $table->tinyInteger('sent_flag')->default(0);
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
        Schema::drop('orders');
    }
}
