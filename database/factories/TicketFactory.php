<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => rand(900854735, 999999999),
            'user_id' => 1,
            'subject' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'select_department' => $this->faker->word,
        ];
    }
}