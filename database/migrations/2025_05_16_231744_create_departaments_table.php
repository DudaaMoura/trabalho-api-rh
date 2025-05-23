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
        Schema::create('departaments', function (Blueprint $table) {
            $table->id();
            $table->string('name');           
            $table->timestamps();
        });

        Schema::create('functionaries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->unsignedBigInteger('departament_id'); // campo da chave estrangeira
            $table->timestamps();

            // Definindo a chave estrangeira
            $table->foreign('departament_id')->references('id')->on('departaments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('functionaries');
        Schema::dropIfExists('departaments');
    }
};
