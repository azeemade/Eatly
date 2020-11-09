<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;
use App\Models\Recipe_Ingredient;
use App\Models\Recipe;

class Recipes_IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Recipe_Ingredient::truncate();

        $faker = \Faker\Factory::create();
        $uu = Recipe::all()->pluck('id')->toArray();
        $vv = Ingredient::all()->pluck('id')->toArray();

        for($i = 0; $i < 10; $i++){
            Recipe_Ingredient::create([
                'ingre_id' => $faker->randomElement($vv),
                'recipe_id' => $faker->randomElement($uu),
            ]);
        }
    }
}
