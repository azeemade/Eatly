<?php

namespace Database\Seeders;

use App\Models\Rating;
use Illuminate\Database\Seeder;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for($i = 0; $i < 50; $i++){
            Rating::create([
                'meal_id' => $this->getMeal(),
                'user_id' => $this->getUser(),
                'points' => $faker->numberBetween(0, 5)
            ]);
        }
    }

    private function getUser(){
        $user = \App\Models\User::where('role', '!=', 'admin')->inRandomOrder()->first();
        return $user->id;
    }

    private function getMeal(){
        $meal = \App\Models\Meal::inRandomOrder()->first();
        return $meal->id;
    }
}
