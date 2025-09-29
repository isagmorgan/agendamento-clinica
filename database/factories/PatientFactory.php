<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    protected $model = Patient::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->name,
            'email' => $this->faker->optional()->safeEmail,
            'phone' => $this->faker->optional()->phoneNumber,
            'birth_date' => $this->faker->optional()->date(),
            'notes' => $this->faker->optional()->sentence()
        ];
    }
}
