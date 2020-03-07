<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item');
            $table->string('shop');
            $table->string('branch')->nullable();
            $table->string('amount')->nullable();
            $table->string('money')->nullable();
            $table->decimal('cospa', 60, 3)->nullable();
            $table->string('comment')->nullable();
            $table->date('date');
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
        Schema::dropIfExists('all_datas');
    }
}
