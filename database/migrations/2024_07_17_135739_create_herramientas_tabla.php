<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('herramientas_tabla', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nombreherramienta', 100);
            $table->integer('cantidad');
            $table->string('codigo', 20);
            $table->string('disponibilidad',20);
            $table->string('sub_area', 40);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('herramientas_tabla');
    }
};
