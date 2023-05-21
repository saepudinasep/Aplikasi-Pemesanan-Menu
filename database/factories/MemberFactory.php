<?php

namespace Database\Factories;

use Faker\Factory as faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $faker = faker::create();
        return [
            'name' => $faker->name(),
            'email' => $faker->unique()->safeEmail(),
            'handphone' => mt_rand(000000000000, 999999999999),
            'joinDate' => now()
        ];
    }
}
