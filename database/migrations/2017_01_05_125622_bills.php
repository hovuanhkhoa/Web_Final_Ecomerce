<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Bills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('BILLS', function (Blueprint $table) {
            $table->increments('ID');
            $table->unsignedInteger('ID_CUSTOMER');
            $table->string('Receiver_name');
            $table->text('Receiver_address');
            $table->string('Receiver_phone');
            $table->string('Detail');
            $table->integer('State');
            $table->timestamps();

            //Foreign key
            $table->foreign('ID_CUSTOMER')->references('ID')->on('CUSTOMERS');
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
        Schema::drop('BILLS');
    }
}
