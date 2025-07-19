<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Complaint>
 */
class ComplaintFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'complaintCategory_id' => 1,
            'description' => fake()->sentence(5),
            'complaintLocation_id' => 1,
            'status' => fake()->randomElement(['pending', 'processing', 'solved', 'closed']),
            // 'created_at' => '2025-02-05 00:00:00',
            // 'updated_at' => '2025-02-05 00:00:00',
            
        ];
    }
}
