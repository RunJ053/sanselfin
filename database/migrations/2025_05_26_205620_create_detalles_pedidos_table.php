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
        Schema::create('detalles_pedidos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cantidad');
            $table->decimal('precio', 8,2);
            $table->decimal('descuento_aplicado', 8,2);
            $table->foreignId('pedidos')->constrained('pedidos')->onDelete('cascade');
            $table->foreignId('productos')->constrained('productos')->onDelete('cascade');
            $table->foreignId('usuario')->constrained('usuarios')->onDelete('cascade');
            $table->foreignId('estados')->constrained('estados')->onDelete('cascade');
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
        Schema::dropIfExists('detalles_pedidos');
    }
};
