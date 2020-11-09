<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User::truncate();

        $faker = \Faker\Factory::create();

        $password = Hash::make('secret123');
        $admin = 'admin';
        $vendor = 'vendor';
        //$consumer = 'consumer';

        User::create([
            'displayname' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@test.com',
            'role' => $admin,
            'password' => $password,
            'image' => 'admin'
        ]);

        for ($i=0; $i<5; $i++){
            User::create([
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'username' => $faker->userName,
                'phoneNumber' => $faker->unique()->phoneNumber,
                'email' => $faker->email,
                'role' => $vendor,
                'password' => $password,
                'image' => 'vendor'
            ]);
        }

        for ($i=0; $i<5; $i++){
            User::create([
                'displayname' => $faker->name,
                'username' => $faker->userName,
                'email' => $faker->email,
                //'role' => $consumer,
                'password' => $password,
                'image' => 'consumer'
            ]);
        }
    }
}
