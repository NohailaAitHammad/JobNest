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
        Schema::create('competence_profile_candidat', function (Blueprint $table) {
            $table->foreignId('profile_candidat_id')
                ->constrained()->onDelete('cascade');
            $table->foreignId('competence_id')
                ->constrained()->onDelete('cascade');
            $table->enum('niveau',
                ['debutant','intermediaire','expert'])
                ->default('debutant');
            $table->softDeletes();
            $table->primary(['profile_candidat_id','competence_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competence_profile_candidat');
    }
};
