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
        Schema::create('unidades_medida', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Ej: Kilogramo, Gramo, Litro, Libra
            $table->string('abreviatura', 10); // Ej: Kg, g, L, lb
            $table->timestamps();
        });

        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('descuento_id')->constrained('promociones')->onDelete('cascade')->nullable();
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->foreignId('estado_id')->constrained('estados')->onDelete('cascade')->default(1);
            $table->string('nombre_producto');
            $table->integer('stock')->default(0);
            $table->string('descripccion');
            $table->foreignId('unidad_medida_id')->constrained('unidades_medida')->onDelete('cascade');
            $table->string('imagen')->nullable();
            $table->decimal('precio_unitario',10,2)->default(0.00);
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
        

        Schema::dropIfExists('productos');
    Schema::dropIfExists('unidades_medida');
    }
};
