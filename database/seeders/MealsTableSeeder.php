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

        for($i = 0; $i < 10; $i++){
            Meal::create([
                'name' => $faker->word,
                'price' => $faker->randomNumber(4),
                'image' => 'IMG_9596_(3)',
                'user_id' => $faker->randomElement($vv),
                'vendor_id' => $faker->randomElement($uu),
            ]);
        }
    }
}
