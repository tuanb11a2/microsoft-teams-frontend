<?php

namespace Database\Factories;

use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $group = Group::whereHas('channels')->inRandomOrder()->first();
        $channel = $group->channels->shuffle()->first();

        return [
            'user_id' => 1,
            'channel_id' => $channel->id,
            'content' => $this->faker->paragraph(),
        ];
    }
}
