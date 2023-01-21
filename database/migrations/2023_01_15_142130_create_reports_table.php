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
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->string('oilType');
            $table->string('boxType');
            $table->string('difType');
            $table->string('oilFilterType');
            $table->string('procedures', 2000);
            $table->string('productsSelected', 2000);
            $table->string('productsAmmount', 2000);
            $table->string('observations', 2000);
            $table->string('prev', 2000);
            $table->string('post', 2000);
            $table->timestamps();
            $table->unique(["id"], 'id_UNIQUE');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
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
