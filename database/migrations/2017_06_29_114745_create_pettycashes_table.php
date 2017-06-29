<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePettycashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pettycashes', function (Blueprint $table) {
            $table->increments('id');
            $table->double('totalcash');
            $table->double('remainingcash');
            $table->double('withdraw');
            $table->string('created_by', 100);
            $table->foreign('created_by')->references('username')->on('users');
            $table->string('modified_by', 100)->nullable();
            $table->foreign('modified_by')->references('username')->on('users');
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
        Schema::dropIfExists('pettycashes');
    }
}
