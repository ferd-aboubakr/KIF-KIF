<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('statistiques', function (Blueprint $table) {
            $table->id();
            $table->enum('type_statistique', ['volume_transactions', 'impact_ecologique', 'densite_industrielle', 'revenus_generes']);
            $table->decimal('valeur', 15, 2);
            $table->date('periode');
            $table->string('region')->nullable();
            $table->string('secteur_activite')->nullable();
            $table->foreignId('administrateur_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statistiques');
    }
};
