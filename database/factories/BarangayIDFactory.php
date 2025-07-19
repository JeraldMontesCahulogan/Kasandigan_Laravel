<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BarangayID>
 */
class BarangayIDFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Generates a random 8-character alphanumeric string as the barangay_id
            // to simulate a real-life barangay ID
            'barangay_id' => $this->faker->regexify('[A-Za-z0-9]{8}'),
        ];
    }
}
