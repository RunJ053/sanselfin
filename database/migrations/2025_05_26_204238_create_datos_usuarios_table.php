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
            // Información necesaria para el usuario
            $table->string('nombre')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('direccion')->nullable();
            $table->foreignId('tipo_docu')->constrained('tipos_documentos')->onDelete('cascade')->nullable();
            $table->foreignId('tipo_de_genero')->constrained('generos')->onDelete('cascade')->nullable();
            $table->bigInteger('documento')->unique()->nullable();
            $table->date('edad')->nullable();
            $table->bigInteger('telefono')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->foreignId('localidad')->constrained('localidades')->onDelete('cascade')->nullable();
            $table->string('password')->nullable();
            $table->string('user_img')->nullable();
            $table->foreignId('role')->constrained('tipos_clientes')->onDelete('cascade')->default(1)->nullable();
            $table->boolean('is_verified')->default(false);
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
