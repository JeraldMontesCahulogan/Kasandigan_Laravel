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
        Schema::create('barangay_i_d_s', function (Blueprint $table) {
            $table->id();
            $table->string('barangay_id');
            $table->timestamps();
        });

        DB::table('barangay_i_d_s')->insert([
            'id' => 1,
            'barangay_id' => '00000000',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangay_i_d_s');
    }
};
