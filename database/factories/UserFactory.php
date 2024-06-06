<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
final class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, Carbon|bool|string>
     */
    public function definition(): array
    {
        return [
            'is_admin' => false,
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => self::$password ??= bcrypt(config('tests.default_password')),
            'remember_token' => Str::random(10),
        ];
    }

    /** Set admin privileges for the model. */
    public function isAdmin(): static
    {
        return $this->state(fn (array $attributes) => array_merge([
            ...$attributes,
            'is_admin' => true,
        ]));
    }

    /** Indicate that the model's email address should be unverified. */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => array_merge([
            ...$attributes,
            'email_verified_at' => null,
        ]));
    }
}
