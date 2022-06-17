<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ManagerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => 'Nhat',
            'email' => 'nhatpham0709@gmail.com',
            'username' => 'nhatpham0709',
            'phone_number' => '034123123312',
            'password' => bcrypt('12345678'),
        ];
    }
}
