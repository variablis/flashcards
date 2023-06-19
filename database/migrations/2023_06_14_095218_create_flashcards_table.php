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
        Schema::create('flashcards', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('question');
            $table->string('answer');
            $table->integer('times_viewed')->default(0);
            $table->integer('times_answered')->default(0);
            $table->timestamp('last_viewed')->nullable();

            $table->foreignId('deck_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flashcards');
    }
};
