<?php

namespace Database\Seeders;

use App\Models\Favourite;
use Illuminate\Database\Seeder;

class FavouritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for($i = 0; $i < 10; $i++){
            Favourite::create([
                'user_id' => $this->getUser(),
            ]);
        }
    }

    private function getUser(){
        $user = \App\Models\User::where('role', '!=', 'admin')->inRandomOrder()->first();
        return $user->id;
    }
}
