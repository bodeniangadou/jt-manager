<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reportages', function (Blueprint $table) {
            $table->id();
            $table->string('titre', 255);
            $table->enum('categorie', ['Politique', 'Économie', 'International', 'Sport']);
            $table->integer('duree')->comment('Durée en minutes');
            $table->string('journaliste', 100);
            $table->integer('ordre_passage')->unique();
            $table->text('resume')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('est_publie')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reportages');
    }
};