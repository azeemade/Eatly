<?php

namespace Database\Seeders;

use App\Models\meal;
use App\Models\Order;
use App\Models\User;
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
        $uu = meal::all()->pluck('id')->toArray();
        $vv = User::where('role', '=', 'consumer')->pluck('id')->toArray();

        for($i = 0; $i < 30; $i++){
            Order::create([
                'address' => $faker->address,
                'quantity' => $faker->numberBetween($min =1, $max = 50),
                'meal_id' => $faker->randomElement($uu),
                'user_id' => $faker->randomElement($vv),
            ]);
        }
    }
}
