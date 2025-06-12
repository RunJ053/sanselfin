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
        Schema::create('facturas_cabeceras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estado_id')->constrained('estados')->onDelete('cascade'); // Estado de la factura (pendiente, pagada, cancelada, etc.)
            $table->foreignId('cliente_id')->constrained('usuarios')->onDelete('cascade'); // Relación con la tabla de clientes
            $table->foreignId('forma_pago_id')->constrained('formas_pagos')->onDelete('cascade'); // Forma de pago utilizada
            $table->string('numero_factura')->unique();
            $table->date('fecha');
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
        Schema::dropIfExists('facturas_cabeceras');
    }
};
