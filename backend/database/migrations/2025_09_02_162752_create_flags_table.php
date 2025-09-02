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
        Schema::create('flags', function (Blueprint $table) {
            $table->id();
            $table->string('flaggable_type'); // Post, Event, Thread, Comment
            $table->unsignedBigInteger('flaggable_id');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('reason'); // spam, abuse, offensive, other
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['flaggable_type', 'flaggable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flags');
    }
};
