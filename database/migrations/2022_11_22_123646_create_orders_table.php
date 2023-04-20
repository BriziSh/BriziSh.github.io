<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            //para ndr
            // $table->string('name')->nullable();
            // $table->string('email')->nullable();
            // $table->string('phone')->nullable();
            // $table->string('address')->nullable();
            // $table->string('title')->nullable();
            // $table->string('price')->nullable();
            // $table->string('quantity')->nullable();
            // $table->string('image')->nullable();

            //para ndr 2
            // $table->unsignedBigInteger('prod_id');
            // $table->foreign('prod_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
           
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            
            // $table->string('price')->nullable();
            // $table->string('quantity')->nullable();
            // $table->string('payment_status')->nullable();
            // $table->string('delivery_status')->nullable();
            // $table->timestamps();
            $table->string('address')->nullable();
            
            $table->unsignedBigInteger('cart_id');
            $table->foreign('cart_id')->references('id')->on('carts')->constrained()->onDelete('cascade')->onUpdate('cascade');
           
            $table->string('payment_status')->nullable();
            $table->string('delivery_status')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
