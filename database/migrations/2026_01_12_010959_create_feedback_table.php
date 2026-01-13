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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('feedbackable_type'); // Notice or Document
            $table->unsignedBigInteger('feedbackable_id');
            $table->enum('type', ['acknowledge', 'disagree', 'concern']);
            $table->text('message')->nullable(); // For concern feedback
            $table->string('attachment')->nullable(); // For concern feedback
            $table->timestamps();
            
            $table->index(['feedbackable_type', 'feedbackable_id']);
            $table->unique(['user_id', 'feedbackable_type', 'feedbackable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
