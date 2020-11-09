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

        $users= DB::table('users')
->where('role', 'vendor')
->pluck('id')->toArray();
        //$array = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11);
        //$vend = json_encode($users);
        $vend = array_rand($users);
        $vv = $users[$vend];

        for($i = 0; $i < 5; $i++){
            Shop::create([
                'name' => $faker->word,
                'image' => 'Bag',
                'description' => $faker->paragraph,
                'vendor_id' =>$vv,
            ]);
        }
    }
}
