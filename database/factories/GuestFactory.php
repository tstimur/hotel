<?php

namespace Database\Factories;

use App\Models\Guest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guest>
 */
class GuestFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Guest::class;
    /**
     * @return array{
     *      first_name: string,
     *      last_name: string,
     *      phone_number: string,
     *      email: string,
     *      country: string,
     *      created_at: \Illuminate\Support\Carbon,
     *      updated_at: \Illuminate\Support\Carbon
     *  }
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'phone_number' => $this->faker->unique()->e164PhoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'country' => $this->faker->country,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
