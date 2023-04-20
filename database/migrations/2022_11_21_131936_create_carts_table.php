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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            // $table->string('name')->nullable();
            // $table->string('phone')->nullable();
            // $table->string('address')->nullable();

            //para ndr db
            // $table->string('email')->nullable();
            // $table->string('title')->nullable();
            // $table->string('price')->nullable();
            // $table->string('quantity')->nullable();
            // $table->string('image')->nullable();
            // $table->string('prod_id')->nullable();
            // $table->string('user_id')->nullable();
            // $table->timestamps();

            //pas ndr db 2
            // $table->string('price')->nullable();
            // $table->string('quantity')->nullable();
            // $table->unsignedBigInteger('prod_id');
            // $table->foreign('prod_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
           
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            // $table->timestamps();

            //pas ndr db 3
            $table->string('price')->nullable();
            $table->string('quantity')->nullable();
            $table->unsignedBigInteger('prod_id');
            $table->foreign('prod_id')->references('id')->on('products')->constrained()->onDelete('cascade')->onUpdate('cascade');
           
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->constrained()->onDelete('cascade')->onUpdate('cascade');

            $table->string('ordered')->default(0);
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
        Schema::dropIfExists('carts');
    }
};
