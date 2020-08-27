<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('group_name',['pizza','sandwitch','snacks','drinks','others'])->default('pizza');
            $table->string('name');
            $table->decimal('cafe_price', 10,2);
            $table->decimal('frozen_price', 10,2);
            $table->decimal('zomato_price', 10,2);
            $table->decimal('swiggy_price', 10,2);
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
        Schema::dropIfExists('items');
    }
}
