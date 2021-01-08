<?php

namespace Database\Seeders;

use App\Models\Favourite;
use App\Models\Favourite_meal;
use App\Models\Favourite_shop;
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

        for($i = 0; $i < 30; $i++){
            Favourite_meal::create([
                'meal_id' => $this->getMealId(),
                'favourite_id' => $this->getFavouriteId(),
            ]);
        }

        for($i = 0; $i < 30; $i++){
            Favourite_shop::create([
                'shop_id' => $this->getShopId(),
                'favourite_id' => $this->getFavouriteId(),
            ]);
        }
    }

    private function getUser(){
        $user = \App\Models\User::where('role', '!=', 'admin')->inRandomOrder()->first();
        return $user->id;
    }

    private function getMealId(){
        $meal = \App\Models\meal::inRandomOrder()->first();
        return $meal->id;
    }

    private function getShopId(){
        $shop = \App\Models\Shop::inRandomOrder()->first();
        return $shop->id;
    }

    private function getFavouriteId(){
        $fav = \App\Models\Favourite::inRandomOrder()->first();
        return $fav->id;
    }
}
