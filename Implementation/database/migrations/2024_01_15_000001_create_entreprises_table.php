<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('ice')->unique();
            $table->string('secteur_activite');
            $table->string('ville');
            $table->string('email')->unique();
            $table->string('telephone');
            $table->enum('statut_validation', ['en_attente', 'validee', 'rejetee'])->default('en_attente');
            $table->timestamp('date_creation')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entreprises');
    }
};
