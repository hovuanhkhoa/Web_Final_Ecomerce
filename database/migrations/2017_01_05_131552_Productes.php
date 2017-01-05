<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Productes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //
        Schema::create('PRODUCTS', function (Blueprint $table) {
            $table->increments('ID');
            $table->unsignedInteger('ID_CATEGORY');
            $table->unsignedInteger('ID_MAKER');
            $table->string('Product_name');
            $table->text('Detail');
            $table->text('Media_set');
            $table->float('Price');
            $table->unsignedInteger('Quantity');
            $table->text('ID_TAG');

            $table->timestamps();

            //Foreign key
            $table->foreign('ID_CATEGORY')->references('ID')->on('CATEGORIES');
            $table->foreign('ID_MAKER')->references('ID')->on('MAKERS');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('PRODUCTS');
    }
}
