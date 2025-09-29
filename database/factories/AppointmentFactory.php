<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition()
    {
        $date = $this->faker->dateTimeBetween('-1 month','+1 month');
        return [
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'patient_id' => Patient::factory(),
            'date' => $date->format('Y-m-d'),
            'time' => $date->format('H:i'),
            'duration_minutes' => 30,
            'status' => $this->faker->randomElement(['scheduled','canceled','done']),
            'notes' => $this->faker->optional()->sentence()
        ];
    }
}
