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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->decimal('total', 8,2);
            $table->string('direccion_envio');
            $table->foreignId('usuario')->constrained('usuarios')->onDelete('cascade');
            $table->foreignId('pagos')->constrained('formas_pagos')->onDelete('cascade');
            $table->foreignId('envios')->constrained('opciones_entrega')->onDelete('cascade');
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
        Schema::dropIfExists('pedidos');
    }
};
