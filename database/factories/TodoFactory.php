<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $types = ['Backlog', 'In progress', 'Review', 'Finished'];
        $priority = ['High', 'Low', 'Medium'];

        return [
            'name' => $this->faker->text(255),
            'group_id' => Group::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'type' => $types[rand(0, 3)],
            'priority' => $priority[rand(0, 2)],
            'deadline' => Carbon::tomorrow()
        ];
    }
}
