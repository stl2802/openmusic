<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bb>
 */
class BbFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'price' => $this->faker->numberBetween(1000, 10000),
            'content' => $this->faker->paragraph(),
            'user_id' => User::factory(),
        ];
    }
}
