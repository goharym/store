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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('status')->after('type')->default(0);
        });
    }

    //        Schema::create('products', function (Blueprint $table) {
//            $table->id();
//            $table->decimal('price');
//            $table->boolean('vat_type');
//            $table->decimal('vat_amount')->nullable();
//            $table->timestamps();
//        });
    //        Schema::create('stores', function (Blueprint $table) {
//            $table->id();
//            $table->bigInteger('merchant_id')->unsigned();
//            $table->foreign('merchant_id')->references('id')->on('users');
//            $table->string('name');
//            $table->timestamps();
//        });

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
