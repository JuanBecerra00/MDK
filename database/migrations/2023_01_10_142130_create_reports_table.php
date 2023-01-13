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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('vehiculo',7);
            $table->string('motivo', 100);
            $table->bigInteger('Kilometraje actual');
            $table->string('Procedimientos', 1000);
            $table->string('observaciones de cada procedimiento', 1500);
            $table->multiLineString('insumos gastados');
            $table->String('observaciones', 1500);
            $table->foreign('vehiculo')->references('id')->on('vehicles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
};
