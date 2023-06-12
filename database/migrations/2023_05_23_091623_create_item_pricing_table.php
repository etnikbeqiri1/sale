<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemPricingTable extends Migration
{
    public function up()
    {
        Schema::create('item_pricing', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('enabled')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('item_pricing');
    }
}
