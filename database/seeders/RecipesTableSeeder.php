<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use Illuminate\Support\Facades\DB;
use App\Models\Ingredient;

class RecipesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Recipe::truncate();

        $faker = \Faker\Factory::create();
       
        $users= DB::table('users')->pluck('id')->toArray();
        $vend = array_rand($users, 1);
        $vv = $users[$vend];

        $uu = Ingredient::all()->pluck('id')->toArray();

        for($i = 0; $i < 10; $i++){
            Recipe::create([
                'name' => $faker->word,
                'image' => 'Cup',
                'Duration' => $faker->numberBetween($min =10, $max = 120),
                //'Duration' => $faker->randomElement([implode(",",[10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120])]),
                'Methods' => $faker->text($maxNbChars = 200),
                'ingre_id' => $faker->numberBetween($min =1, $max = 30),
                //'Time' => $faker->randomElement($array = array('Breakfast','Lunch','Dinner')),
               // (['Breakfast', 'Lunch', 'Dinner']),
                //'Region' => $faker->randomElement($array = array('Western', 'Eastern', 'Northern', 'African', 'International')),
                'Time' => $faker->word,
                'Region' => $faker->word,
                'user_id' => $vv,
            ]);
        }

        
    }
}
