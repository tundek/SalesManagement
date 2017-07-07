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
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('quantity');
            $table->double('totalamount');
            $table->double('paidamount');
            $table->double('dueamount');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->datetime('order_pick');
            $table->string('message');
            $table->boolean('delivered_status')->default(0);
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
