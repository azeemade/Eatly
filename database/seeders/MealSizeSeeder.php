<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Meal_size;
use Illuminate\Database\Seeder;

class MealSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for($i = 0; $i < 30; $i++){
            Meal_size::create([
                'meal_id' => $this->getMealId(),
                'meal_size' => $this->getMealSize()
            ]);
        }
    }

    private function getMealId(){
        $meal = \App\Models\meal::inRandomOrder()->first();
        return $meal->id;
    }

    private function getMealSize(){
        $size = ["small", "medium", "large", "xl", "xxl"];
        $size_ = array_rand($size);
        return $size[$size_];
    }
}
