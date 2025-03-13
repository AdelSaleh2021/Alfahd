<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Adel1',
            'email' => 'adel1@gmail.com',
            'password' => bcrypt('adel1'), // use bcrypt for passwords
        ]);
        User::create([
            'name' => 'Adel2',
            'email' => 'adel2@gmail.com',
            'password' => bcrypt('adel2'), // use bcrypt for passwords
        ]);
        User::create([
            'name' => 'Adel3',
            'email' => 'adel3@gmail.com',
            'password' => bcrypt('adel3'), // use bcrypt for passwords
        ]);
        // Add more users as needed
    }
}
