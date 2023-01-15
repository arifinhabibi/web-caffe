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
        Schema::create('menu_choosens', function (Blueprint $table) {
            $table->id();
            $table->string('menu');
            $table->string('total_menu');
            $table->integer('price');
            $table->unsignedBigInteger('bill_orders_id');
            $table->foreign('bill_orders_id')->references('id')->on('bill_orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_choosens');
    }
};
