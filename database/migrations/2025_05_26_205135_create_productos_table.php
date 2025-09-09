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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('descuento_id')->constrained('promociones')->onDelete('cascade')->nullable();
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->foreignId('estado_id')->constrained('estados')->onDelete('cascade')->default(1);
            $table->string('nombre_producto');
            $table->integer('stock')->default(0);
            $table->text('descripccion')->nullable();
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
    }
};
