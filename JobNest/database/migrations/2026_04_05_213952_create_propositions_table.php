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
        Schema::create('propositions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recruteur_id')
                ->constrained('users')->onDelete('cascade');
            $table->foreignId('candidat_id')
                ->constrained('users')->onDelete('cascade');
            $table->string('titre');
            $table->text('description');
            $table->enum('type', ['stage','emploi','alternance']);
            $table->string('duree');
            $table->enum('status', ['pending','accepter','refuser'])
                ->default('pending');
            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propositions');
    }
};
