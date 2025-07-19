<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feedback>
 */
class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rating' => fake()->randomElement(['excellent', 'good', 'fair', 'poor']),
            'service_feedback' => $this->faker->sentence(2), // Random feedback text
            'improvement_suggestions' => $this->faker->sentence(2), // Random suggestion text
            'anonymous' => fake()->boolean(),
        ];
    }
}
