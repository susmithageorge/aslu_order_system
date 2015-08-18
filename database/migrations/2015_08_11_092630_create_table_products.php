<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table)
        {
          //"ID", "Code", "Name", "Std_Rate", "Sales_Rate", "Market_Rate", "MinRetailPrice", "MaxRetailPrice"
          $table->increments('id');
          $table->integer('user_id')->unsigned()->nullable();
          $table->integer('itemmaster_id')->unsigned()->nullable();
          $table->integer('manufacturer_id')->unsigned()->nullable();
          $table->text('name');
          $table->string('code', 255);
          $table->decimal('std_rate', 19, 4);
          $table->decimal('sales_rate', 19, 4);
          $table->decimal('market_rate', 19, 4);
          $table->decimal('min_retail_price', 19, 4);
          $table->decimal('max_retail_price', 19, 4);
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
        Schema::drop('products');
    }
}
