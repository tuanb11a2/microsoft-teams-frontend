<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Group;
use App\Models\User;
use Carbon\Carbon;

class ExerciseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'group_id' => Group::inRandomOrder()->first()->id,
            'description' => $this->faker->text(),
            'title' => $this->faker->text(200),
            'description' => $this->faker->text(),
            'content' => $this->faker->text(),
            'grade' => random_int(0, 100),
            'deadline' => Carbon::tomorrow(),
            'status' => 'assigned'
        ];
    }
}
