<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;

class ImageTableSeeder extends Seeder
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
            Image::create([
                'meal_id' => $this->getMealId(),
                'url' => $this->getURL(),
                'primary' => $faker->boolean()
                
            ]);
        }
    }

    private function getMealId(){
        $meal = \App\Models\meal::inRandomOrder()->first();
        return $meal->id;
    }

    private function getURL(){
        $url = ["meal1", "meal2", "meal3", "meal4", "meal5"];
        $url_ = array_rand($url);
        return $url[$url_];
    }

    
}
