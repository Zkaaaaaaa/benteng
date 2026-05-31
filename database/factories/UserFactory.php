<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Factory untuk model User (akun dummy pengujian).
 *
 * @extends Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Password default yang dipakai ulang antar instance factory.
     */
    protected static ?string $password;

    /**
     * Menyusun atribut default user untuk database seeder dan test.
     */
    public function definition(): array
    {
        return [
            'name'              => fake()->name(),
            'email'             => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => static::$password ??= Hash::make('password'),
            'remember_token'    => Str::random(10),
        ];
    }

    /**
     * Menandai user dengan email yang belum diverifikasi.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
