<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingTable extends Migration
{
    public function up()
    {
        Schema::create('price', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('price');
            $table->double('start_price');
            $table->integer('enabled')->default(1);
            $table->unsignedBigInteger('item_pricing_id');
            $table->foreign('item_pricing_id')->references('id')->on('item_pricing');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('price');
    }
}
