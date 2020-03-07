<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemShopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_shop', function (Blueprint $table) {
            $table->increments('id'); // item,shopがユニークではないため
            $table->integer('item_id')->unsigned();
            $table->integer('shop_id')->unsigned();
            $table->timestamps();

            $table->foreign('item_id')
            ->references('id')->on('items')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('shop_id')
            ->references('id')->on('shops')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_shop');
    }
}
