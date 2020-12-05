<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\meal;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Shop;

class MealsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Meal::truncate();

        $faker = \Faker\Factory::create();
        $vv = User::where('role', '=', 'vendor')->pluck('id')->toArray();
        $uu = Shop::all()->pluck('id')->toArray();

        for($i = 0; $i < 7; $i++){
            Meal::create([
                'name' => $faker->word,
                'price' => $faker->randomNumber(4),
                'image' => 'IMG_9596_(3)',
                'user_id' => $this->getUser(),
                'vendor_id' => $this->getVendor(),
                'status' => 'active'
            ]);
        }

        for($i = 0; $i < 3; $i++){
            Meal::create([
                'name' => $faker->word,
                'price' => $faker->randomNumber(4),
                'image' => 'IMG_9596_(3)',
                'user_id' => $this->getUser(),
                'vendor_id' => $this->getVendor(),
                'status' => 'cancelled'
            ]);
        }

        for($i = 0; $i < 5; $i++){
            Meal::create([
                'name' => $faker->word,
                'price' => $faker->randomNumber(4),
                'image' => 'IMG_9596_(3)',
                'user_id' => $this->getUser(),
                'vendor_id' => $this->getVendor(),
            ]);
        }

        
    }

    private function getUser(){
        $user = \App\Models\User::inRandomOrder()->where('role', '=', 'vendor')->first();
        return $user->id;
    }
    private function getVendor(){
        $shop = \App\Models\Shop::inRandomOrder()->first();
        //$meal = \App\Models\meal::where('vendor_id', '=', $shop->id)->first();
        
        return $shop->id;
    }
}
