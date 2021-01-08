<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Cart_meal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartsTableSeeder extends Seeder
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
            Cart::create([
                'user_id' => $this->getUser(),
           ]);
        }
        
        $meal_id = $this->getMeal();

        for($i = 0; $i < 30; $i++){
            Cart_meal::create([
                'meal_id' => $meal_id,
                'cart_id' => $this->getCartId(),
                'meal_size_id'  => $this->getMealSize($meal_id),
                'quantity' => $faker->numberBetween(1,10)
            ]);
        }
    }

    private function getUser(){
        $user = \App\Models\User::where('role', '!=', 'admin')->inRandomOrder()->first();
        return $user->id;       
    }

    private function getMeal(){
        $meal = \App\Models\meal::where('meal_approval', 'active')->inRandomOrder()->first();
        return $meal->id;
    }

    private function getCartId(){
        $cart = \App\Models\Cart::inRandomOrder()->first();
        return $cart->id;
    }

    private function getMealSize($meal_id){
        $meal_size = \App\Models\Meal_size::inRandomOrder()->where('meal_id', '=', $meal_id)->first();
        return $meal_size->id;
    }
}
