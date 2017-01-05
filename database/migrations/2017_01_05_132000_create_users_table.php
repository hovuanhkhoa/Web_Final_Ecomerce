<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('ID');
            $table->unsignedInteger('ID_CUSTOMER');
            $table->string('Username')->unique();
            $table->string('Password');
            $table->unsignedInteger('ID_ROLE');
            $table->timestamps();

            //Foreign key
            $table->foreign('ID_CUSTOMER')->references('ID')->on('customers');
            $table->foreign('ID_ROLE')->references('ID')->on('roles');
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
