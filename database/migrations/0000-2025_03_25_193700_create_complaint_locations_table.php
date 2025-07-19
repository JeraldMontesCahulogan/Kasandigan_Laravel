<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('complaint_locations', function (Blueprint $table) {
            $table->id();
            $table->string('complaintLocation_name');
            $table->timestamps();
        });

        DB::table('complaint_locations')->insert([
            'id' => 1,
            'complaintLocation_name' => 'Sample Location',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_locations');
    }
};
