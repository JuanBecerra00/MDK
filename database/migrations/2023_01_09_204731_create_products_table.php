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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('providers_id')->nullable();
            $table->foreignId('bills_id')->nullable();
            $table->string('name',45);
            $table->double('ammount',4,2);
            $table->double('price',10,2);
            $table->date('date');
            $table->set('type',['I','C']);
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
        Schema::dropIfExists('products');
    }
};
