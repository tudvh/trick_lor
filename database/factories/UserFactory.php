<?php

namespace Database\Factories;

use App\Enums\User\UserStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userStatus = UserStatus::getValues();
        $createdAt = fake()->dateTimeBetween('2020-01-01 00:00:00', now());

        return [
            'full_name' => fake()->name(),
            'email' => fake()->email(),
            'username' => fake()->userName(),
            'password' => bcrypt('password'),
            'status' => fake()->randomElement($userStatus),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }
}
