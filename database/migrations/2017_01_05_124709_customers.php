<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Customers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('CUSTOMERS', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('Customer_name');
            $table->string('Identify_number')->unique();
            $table->string('Phone');
            $table->string('Email');
            $table->text('Address');
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
        //
        Schema::drop('CUSTOMERS');
    }
}
