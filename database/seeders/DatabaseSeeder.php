<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\BarangayID;
use App\Models\Complaint;
use App\Models\Feedback;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Complaint::factory(20)->create();

        // BarangayID::factory(1)->create();

        // Feedback::factory(10)->create();

    }
}
