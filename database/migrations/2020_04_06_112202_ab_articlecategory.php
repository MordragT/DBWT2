<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AbArticlecategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ab_articlecategory', function (Blueprint $table) {
            $table->bigIncrements('id')
                ->comment('Primärschlüssel');
            $table->string('ab_name', 100)
                ->unique()
                ->comment('Name');
            $table->string('ab_description', 1000)
                ->nullable(true)
                ->comment('Beschreibung');
            $table->bigInteger('ab_parent')
                ->nullable(true)
                ->comment('');

            $table->foreign('ab_parent')
                ->on('ab_articlecategory')
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
        Schema::drop('ab_articlecategory');
    }
}
