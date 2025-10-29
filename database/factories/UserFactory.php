<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

  /**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
      /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

      /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name'        => fake()->firstName(),
            'last_name'         => fake()->lastName(),
            'email'             => fake()->unique()->safeEmail(),
            'phone'             => fake()->unique()->phoneNumber(),
            'role'              => $this->faker->randomElement(['candidate', 'employer']),
            'email_verified_at' => $this->faker->optional()->dateTime(),
            'password'          => static::$password ??= Hash::make('password'),
            'status'            => $this->faker->randomElement(['active', 'inactive']),
        ];
    }

      /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
