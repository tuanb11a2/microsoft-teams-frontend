<?php

namespace Database\Factories;

use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
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
        $post = $channel->posts->shuffle()->first();

        return [
            'user_id' => 1,
            'post_id' => $post->id,
            'content' => $this->faker->paragraph(),
        ];
    }
}
