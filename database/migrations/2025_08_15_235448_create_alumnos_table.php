<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->date('fecha_nacimiento');
            $table->string('rut')->unique();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('direccion')->nullable();
            $table->unsignedBigInteger('sede_id')->nullable();
            $table->unsignedBigInteger('instructor_id')->nullable();
            $table->date('fecha_ultimo_examen')->nullable();
            $table->boolean('tiene_apoderado')->default(false);
            $table->timestamps();

            $table->foreign('sede_id')->references('id')->on('sedes')->onDelete('set null');
            $table->foreign('instructor_id')->references('id')->on('instructores')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
