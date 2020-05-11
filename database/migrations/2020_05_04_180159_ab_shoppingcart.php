<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AbShoppingcart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ab_shoppingcart', function (Blueprint $table) {
            $table->bigIncrements('id')
                ->comment('Primärschlüssel');
            $table->bigInteger('ab_creator_id')
                ->comment('Referenz auf den Benutzer, dem der Warenkorb gehört');
            $table->timestamp('ab_createdate')
                ->nullable(false)
                ->comment('Zeitpunkt der Erstellung');

            $table->foreign('ab_creator_id')
                ->on('ab_user')
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
        Schema::drop('ab_shoppingcart');
    }
}
