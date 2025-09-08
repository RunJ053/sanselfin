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
        Schema::create('facturas_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('factura_cabecera_id')->constrained('facturas_cabeceras')->onDelete('cascade');
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('subTotal', 10, 2); // Subtotal (cantidad * precio_unitario)
            $table->decimal('descuento', 10, 2)->default(0.00); // Monto del impuesto aplicado
            $table->decimal('envio', 10, 2)->default(0.00); // Monto del impuesto aplicado
            $table->decimal('montoTotal', 10, 2)->default(0.00); // Monto del impuesto aplicado
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
        Schema::dropIfExists('facturas_detalles');
    }
};
