<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Shop::truncate();

        $faker = \Faker\Factory::create();

        $vv= DB::table('users')
->where('role', 'vendor')
->pluck('id')->toArray();

        for($i = 0; $i < 5; $i++){
            Shop::create([
                'name' => $faker->word,
                'image' => 'Bag',
                'description' => $faker->paragraph,
                'vendor_id' =>$faker->randomElement($vv),
            ]);
        }
    }
}
