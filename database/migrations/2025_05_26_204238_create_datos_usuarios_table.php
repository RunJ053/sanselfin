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
        Schema::create('datos_usuario', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('direccion');
            $table->foreignId('pregunta_seguridad')->constrained('seguridad')->onDelete('cascade');
            $table->string('respuesta_seguridad');
            $table->foreignId('tipo_docu')->constrained('tipos_documentos')->onDelete('cascade');
            $table->foreignId('tipo_client')->constrained('tipos_clientes')->onDelete('cascade')-> default(1);
            $table->foreignId('tipo_de_genero')->constrained('generos')->onDelete('cascade');
            $table->bigInteger('documento')->unique();
            $table->date('edad');
            $table->mediumInteger('telefono')->unique();
            $table->string('email')->unique();
            $table->string('localidad');
            
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
        Schema::dropIfExists('datos_usuario');
        Schema::dropIfExists('tipos_clientes');
        Schema::dropIfExists('tipos_documentos');
        Schema::dropIfExists('seguridad');
        Schema::dropIfExists('generos');
    }
};
