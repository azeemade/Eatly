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
        $faker = \Faker\Factory::create();
        for($i = 0; $i < 15; $i++){
            Meal::create([
                'meal_name' => $faker->word(),
                'meal_price' => $faker->randomFloat(2, 800, 20000),
                'meal_slug' => $faker->slug(),
                'meal_additional_text' => $faker->sentences(2, 10, 10000),
                'meal_approval' => $this->getApproval(),
                'meal_status' => $this->getStatus(),
                'user_id' => $this->getUser(),
                'vendor_id' => $this->getVendor()             
            ]);
        }
    }

    public function getUser(){
        $user = \App\Models\User::inRandomOrder()->where('hasShop', '=', 'Yes')->first();

        return $user->id;
    }
    public function getVendor(){
        $shop = \App\Models\Shop::where('shop_vendor_id', $this->getUser())->first();

        return $shop->id;
    }
    public function getApproval(){
        $app = ["active", "awaiting", "cancelled"];
        $app_ = array_rand($app);
        return $app[$app_];
    }
    public function getStatus(){
        $stat = ["in-stock", "out-of-stock"];
        $stat_ = array_rand($stat);
        return $stat[$stat_];
    }
}
