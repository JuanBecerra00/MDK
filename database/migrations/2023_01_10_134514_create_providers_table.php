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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nit');
            $table->string('name',45);
            $table->bigInteger('phone');
            $table->rememberToken();
            $table->timestamps();
            $table->set('status', ['0', '1'])->default('1');
            $table->unique(["id"], 'id_UNIQUE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('providers');
    }
};