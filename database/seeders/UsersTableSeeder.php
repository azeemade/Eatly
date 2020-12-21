<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $password = Hash::make('secret123');

        User::create([
            'displayname' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@test.com',
            'role' => 'admin',
            'password' => $password,
            'user_image' => 'admin'
        ]);

        for ($i=0; $i<5; $i++){
            User::create([
                'displayname' => $faker->name,
                'username' => $faker->userName,
                'email' => $faker->email,
                'password' => $password,
                'user_image' => 'consumer'
            ]);
        }
    }
}
