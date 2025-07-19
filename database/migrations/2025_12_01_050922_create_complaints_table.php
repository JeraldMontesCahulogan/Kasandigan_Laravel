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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('complaintCategory_id');
            $table->foreign('complaintCategory_id')->references('id')->on('complaint_categories')->onDelete('restrict');
            $table->text('description');
            $table->unsignedBigInteger('complaintLocation_id');
            $table->foreign('complaintLocation_id')->references('id')->on('complaint_locations')->onDelete('restrict');

            $table->string('status')->default('pending');
            $table->string('attachment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};

//2025_03_01_050922
