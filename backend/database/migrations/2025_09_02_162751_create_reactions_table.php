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
        Schema::create('reactions', function (Blueprint $table) {
            $table->id();
            $table->string('reactable_type'); // Post, Event, Thread, Comment
            $table->unsignedBigInteger('reactable_id');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('type'); // like, love, clap, wow, etc.
            $table->timestamps();

            $table->index(['reactable_type', 'reactable_id']);
            $table->unique(['user_id', 'reactable_type', 'reactable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reactions');
    }
};
