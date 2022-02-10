<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'name' => $this->faker->name(),
      'email' => $this->faker->unique()->safeEmail(),
      'phone' => $this->faker->unique()->phoneNumber(),
      'email_verified_at' => now(),
      'password' => '111111',
      'remember_token' => Str::random(10),
    ];
  }
}
