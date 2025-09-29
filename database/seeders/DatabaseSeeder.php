<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Patient;
use App\Models\Appointment;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory(3)->create()->each(function($user) {
            Patient::factory(10)->create(['user_id' => $user->id])->each(function($patient) use ($user) {
                Appointment::factory(5)->create([
                    'user_id' => $user->id,
                    'patient_id' => $patient->id
                ]);
            });
        });
    }
}
