<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AbShoppingcartItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ab_shoppingcart_item', function (Blueprint $table) {
            $table->bigIncrements('id')
                ->comment('Primärschlüssel');
            $table->bigInteger('ab_shoppingcart_id')
                ->comment('Referenz auf den Warenkorb');
            $table->bigInteger('ab_article_id')
                ->comment('Referenz auf den Artikel');
            $table->timestamp('ab_createdate')
                ->nullable(false)
                ->comment('Zeitpunkt der Erstellung');

            $table->foreign('ab_shoppingcart_id')
                ->on('ab_shoppingcart')
                ->references('id')
                ->onDelete('cascade');

            $table->foreign('ab_article_id')
                ->on('ab_article')
                ->references('id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ab_shoppingcart_item');
    }
}
