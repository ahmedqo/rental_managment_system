<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'email' => 'admin@test.com',
            'phone' => '212000000000',
            'identity' => '00000000',
            'firstName' => 'john',
            'lastName' => 'doe',
            'address' => 'address',
            'state' => 'state',
            'city' => 'city',
            'zipcode' => '000000',
            'birthDate' => '2000-01-01',
            'gender' => 'male',
        ]);
        Setting::create([
            'assurance' => 100,
            'icecream' => 50,
            'kayak' => 10,
        ]);
    }
}
