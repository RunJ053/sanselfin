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
    Schema::create('tareas', function (Blueprint $table) {
        $table->id();
        $table->string('titulo', 100);
        $table->text('descripcion')->nullable();
        $table->enum('tipo', ['pendiente', 'hecha'])->default('pendiente');
        $table->timestamp('fecha_creacion')->useCurrent();
    });
}


    /**php artisan make:model Tarea -c

     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tareas');
    }
};
