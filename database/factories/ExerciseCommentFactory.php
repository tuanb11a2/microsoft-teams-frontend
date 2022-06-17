<?php

namespace Database\Factories;

use App\Models\Exercise;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExerciseCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'exercise_id' => Exercise::inRandomOrder()->first()->id,
            'content' => $this->faker->text(),
        ];
    }
}
