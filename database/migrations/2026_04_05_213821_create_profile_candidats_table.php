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
        Schema::create('profile_candidats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()->onDelete('cascade');
            $table->string('imageURL')->nullable();
            $table->string('ville')->nullable();
            $table->string('telephone')->nullable();
            $table->string('cv_url')->nullable();
            $table->string('portfolio_url')->nullable();
            $table->boolean('est_visible')->default(true);
            $table->timestamps();
            $table->engine('innoDB');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_candidats');
    }
};
