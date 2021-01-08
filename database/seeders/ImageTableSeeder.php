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
                'master' => $faker->boolean()
                
            ]);
        }
    }

    private function getMealId(){
        $meal = \App\Models\meal::inRandomOrder()->first();
        return $meal->id;
    }

    private function getURL(){
        $url = ["meal1.jpg", "meal2.jpg", "suya.png", "18_spaghetti_and_turkey_wings_2020-12-24_1608795847_276.png"];
        $url_ = array_rand($url);
        return $url[$url_];
    }

    
}
