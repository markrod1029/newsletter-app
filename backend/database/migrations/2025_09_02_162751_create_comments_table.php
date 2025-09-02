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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('commentable_type'); // Post, Event, Thread
            $table->unsignedBigInteger('commentable_id');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('body');
            $table->enum('status', ['visible', 'hidden', 'flagged'])->default('visible');
            $table->timestamps();

            $table->index(['commentable_type', 'commentable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
