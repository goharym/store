<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->bigInteger('store_id')->unsigned();
            $table->foreign('store_id')->references('id')->on('stores');
            $table->boolean('status')->default(0);
            $table->decimal('price');
            $table->boolean('vat_type')->default(0);
            $table->decimal('vat_amount')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
