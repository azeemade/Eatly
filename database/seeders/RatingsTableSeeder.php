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
        for($i = 0; $i < 10; $i++){
            $order_id = $this->getOrder();
            Rating::create([
                'meal_id' => $this->getMeal($order_id),
                'user_id' => $this->getUser($order_id),
                'points' => $faker->numberBetween(0, 5),
                'order_id' => $this->getOrder()
            ]);
        }
    }

    private function getUser($order_id){
        $order = \App\Models\Order::where('id', $order_id)->first();
        return $order->user_id;
    }

    private function getMeal($order_id){
        $order = \App\Models\Order::where('id', $order_id)->first();
        return $order->meal_id;
    }
    private function getOrder(){
        $order = \App\Models\Order::where('is_delivered', '=', 1)->inRandomOrder()->first();
        return $order->id;
    }
}
