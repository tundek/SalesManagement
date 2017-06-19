<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preorders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name');
            $table->integer('quantity');
            $table->double('totalamount');
            $table->double('paidamount');
            $table->double('dueamount');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->datetime('order_pick');
            $table->string('message');
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
        Schema::dropIfExists('preorders');
    }
}