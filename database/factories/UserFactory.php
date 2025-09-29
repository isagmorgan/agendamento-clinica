<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        $password = Hash::make('password'); // padrão para dev
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'crm' => $this->faker->bothify('CRM###-##'),
            'password' => $password,
            'remember_token' => Str::random(10)
        ];
    }
}
