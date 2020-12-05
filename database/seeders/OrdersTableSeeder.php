<?php

namespace Database\Seeders;

use App\Models\meal;
use App\Models\Order;
use App\Models\Shop;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Order::truncate();

        $faker = \Faker\Factory::create();
       // $uu = meal::pluck('id')->toArray();
       // $vv = User::where('role', '=', 'consumer')->pluck('id')->toArray();
        //$ww = Shop::all()->pluck('id')->first();
       // $yy = meal::where('vendor_id', '=', $ww)->toArray();

        for($i = 0; $i < 30; $i++){
            Order::create([
                'address' => $faker->address,
                'quantity' => $faker->numberBetween($min =1, $max = 50),
                //'meal_id' => $faker->randomElement($uu),
                'meal_id' => $this->getMeal(),
                //'user_id' => $faker->randomElement($vv),
                'user_id' => $this->getUser(),
                //'vendor_id' => $faker->randomElement($yy),
                'vendor_id' => $this->getVendor(),
            ]);
        }
    }

    private function getUser(){
        $user = \App\Models\User::inRandomOrder()->where('role', '=', 'consumer')->first();
        return $user->id;
    }
    private function getMeal(){
        $meal = \App\Models\meal::inRandomOrder()->first();
        return $meal->id;
    }
    private function getVendor(){
        $shop = \App\Models\Shop::inRandomOrder()->first();
        $meal = \App\Models\meal::where('vendor_id', '=', $shop->id)->first();
        
        return $meal->vendor_id;
    }
}
