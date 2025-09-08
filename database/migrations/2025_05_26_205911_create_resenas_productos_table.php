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
        Schema::create('resenas_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('datos_usuario')->onDelete('cascade');
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->tinyInteger('calificacion')->default(0)->comment('1 a 5');
            $table->text('comentario')->nullable();
            $table->timestamps();

            // Evita reseñas duplicadas de un usuario sobre el mismo producto
            $table->unique(['usuario_id', 'producto_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resenas_productos');
    }
};
