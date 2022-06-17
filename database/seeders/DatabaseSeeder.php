<?php

namespace Database\Seeders;

use App\Models\Channel;
use App\Models\Comment;
use App\Models\Manager;
use App\Models\User;
use App\Models\Group;
use App\Models\Exercise;
use App\Models\ExerciseComment;
use App\Models\Friend;
use App\Models\Message;
use App\Models\Post;
use App\Models\Todo;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::query()->create([
            'name' => 'Nhat',
            'email' => 'nhatpham0709@gmail.com',
            'username' => 'nhatpham0709',
            'phone_number' => '034123123312',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'avatar' => 'https://natashaskitchen.com/wp-content/uploads/2020/05/Vanilla-Cupcakes-3.jpg',
            'remember_token' => Str::random(10),
        ]);
        User::factory(100)->create();
        Friend::factory(100)->create();

        Manager::factory(1)->create();
        Group::factory(20)->create();
        Channel::factory(20)->create();
        Exercise::factory(20)->create();
        ExerciseComment::factory(20)->create();
        Todo::factory(20)->create();
        Post::factory(200)->create();
        Comment::factory(100)->create();

        for ($i = 0; $i < 20; $i++) {
            Friend::query()->create([
                'user_id' => User::inRandomOrder()->first()->id,
                'friend_id' => '1'
            ]);

            DB::table('group_user')->insert([
                'group_id' => Group::inRandomOrder()->first()->id,
                'user_id' => 1
            ]);

            DB::table('group_user')->insert([
                'group_id' => Group::inRandomOrder()->first()->id,
                'user_id' => User::inRandomOrder()->first()->id
            ]);

            Message::query()->create([
                'channel_id' => Channel::inRandomOrder()->first()->id,
                'sender_id' => User::inRandomOrder()->first()->id,
                'content' => Factory::create()->paragraph(),
            ]);

            Message::query()->create([
                'receiver_id' => User::inRandomOrder()->first()->id,
                'sender_id' => User::inRandomOrder()->first()->id,
                'content' => Factory::create()->paragraph(),
            ]);

            DB::table('exercise_user')->insert([
                'user_id' => User::inRandomOrder()->first()->id,
                'exercise_id' => Exercise::inRandomOrder()->first()->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
