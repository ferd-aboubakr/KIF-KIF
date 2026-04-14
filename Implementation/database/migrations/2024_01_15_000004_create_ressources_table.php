<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ressources', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description');
            $table->enum('type_ressource', ['matiere_premiere', 'sous_produit', 'machine', 'espace_stockage']);
            $table->decimal('quantite', 10, 2);
            $table->string('unite');
            $table->string('etat');
            $table->decimal('prix_unitaire', 10, 2);
            $table->string('localisation');
            $table->json('photos')->nullable();
            $table->enum('statut', ['active', 'vendue', 'en_attente', 'archivee'])->default('active');
            $table->timestamp('date_publication')->useCurrent();
            $table->foreignId('entreprise_id')->constrained('entreprises')->onDelete('cascade');
            $table->foreignId('categorie_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ressources');
    }
};
