<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            'title' => fake()->realText(10),
            'content' => fake()->realText(200),
            'tag_id' => random_int(1,3),
            'user_id' => 1,
            'status' => 1,
        ];
    }
}
