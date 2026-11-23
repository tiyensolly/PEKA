<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_logs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('log_date');
            $table->unsignedTinyInteger('stress_level');
            $table->boolean('ate_breakfast')->default(false);
            $table->boolean('ate_lunch')->default(false);
            $table->boolean('ate_dinner')->default(false);
            $table->json('symptoms')->nullable();
            $table->unsignedTinyInteger('symptom_severity')->default(0);
            $table->json('triggers')->nullable();
            $table->text('note')->nullable();
            $table->string('photo_path')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'log_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_logs');
    }
};