<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Carts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('carts', function (Blueprint $table) {
            $table->increments('ID');
            $table->unsignedInteger('ID_CUSTOMER');
            $table->string('Detail');
            $table->timestamps();

            //Foreign key
            $table->foreign('ID_CUSTOMER')->references('ID')->on('customers');
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
        Schema::drop('carts');
    }
}
