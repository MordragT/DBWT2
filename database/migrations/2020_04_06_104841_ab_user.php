<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AbUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ab_user', function (Blueprint $table) {
            $table->bigIncrements('id')
                    ->comment('Primärschlüssel');
            $table->string('ab_name',80)
                    ->unique()
                    ->comment('Name');
            $table->string('ab_password',200)
                    ->nullable(false)
                    ->comment('Passwort');
            $table->string('ab_mail',200)
                    ->unique()
                    ->comment('E-Mail-Adresse');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ab_user');
    }
}
