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
        Schema::create('domaine_entreprise', function (Blueprint $table) {
            $table->foreignId('entreprise_id')
                ->constrained()->onDelete('cascade');
            $table->foreignId('domaine_id')
                ->constrained()->onDelete('cascade');
            $table->primary(['entreprise_id','domaine_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domaine_entreprise');
    }
};
