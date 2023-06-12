<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    public function up()
    {
        Schema::create('session', function (Blueprint $table) {
            $table->id();
            $table->boolean('paid')->default(0);
            $table->timestamp('started_at')->useCurrent();
            $table->integer('duration')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->unsignedBigInteger('price_id');
            $table->foreign('price_id')->references('id')->on('price');
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
