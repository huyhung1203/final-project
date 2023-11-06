<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_details', function (Blueprint $table) {
         $table->id();
      
          $table->double('price');
        
          $table->integer('product_quantity');
          $table->bigInteger('product_id')->unsigned();
          $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
          $table->bigInteger('size_id')->unsigned();
          $table->foreign('size_id')->references('id')->on('sizes');
          $table->bigInteger('color_id')->unsigned();
          $table->foreign('color_id')->references('id')->on('colors');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_details');
    }
};
