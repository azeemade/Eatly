<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
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
            Comment::create([
                'meal_id' => $this->getMeal(),
                'user_id' => $this->getUser(),
                'review' => $faker->paragraph()
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
