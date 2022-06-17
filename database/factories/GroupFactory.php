<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(200),
            'privacy' => 'public',
            'slug' => Str::uuid()->toString(),
            'avatar' => 'https://natashaskitchen.com/wp-content/uploads/2020/05/Vanilla-Cupcakes-3.jpg',
        ];
    }
}
