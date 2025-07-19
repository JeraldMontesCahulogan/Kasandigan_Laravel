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
            // The user who submitted the feedback, can be null if the user wants to remain anonymous
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('rating'); // Store 1-5 based on the rating
            $table->text('service_feedback')->nullable();
            $table->text('improvement_suggestions')->nullable();
            $table->boolean('anonymous')->default(true);
            $table->boolean('isQuest')->default(false);
            $table->timestamps();
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
