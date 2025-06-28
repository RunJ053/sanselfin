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
            //informacion necesaria para el usuario
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('direccion');
            $table->foreignId('pregunta_seguridad')->constrained('seguridad')->onDelete('cascade')->nullable();
            $table->string('respuesta_seguridad')->nullable();
            $table->foreignId('tipo_docu')->constrained('tipos_documentos')->onDelete('cascade')->nullable();
            $table->foreignId('tipo_de_genero')->constrained('generos')->onDelete('cascade')->nullable();
            $table->bigInteger('documento')->unique()->nullable();
            $table->date('edad')->nullable();
            $table->bigInteger('telefono')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('localidad')->nullable();
            //creacion de una cuenta para el usuario
            //$table->string('nombre_usuario');
            $table->string('password');
            $table->string('user_img')->nullable();
            $table->foreignId('role')->constrained('tipos_clientes')->onDelete('cascade')->default(1); // Añadir columna role
            $table->boolean('is_verified')->default(false); // Añadir columna is_verified
            $table->string('nom_imgs')->nullable();
            
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
       Schema::dropIfExists('datos_usuario'); // Luego elimina la tabla
   }
};