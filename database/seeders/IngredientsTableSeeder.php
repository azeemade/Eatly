<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;
use App\Models\Recipe;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Ingredient::truncate();

        $faker = \Faker\Factory::create();
        $uu = Recipe::all()->pluck('id')->toArray();

        for($i = 0; $i < 30; $i++){
            Ingredient::create([
                'name' => $faker->word,
                'image' => 'Flower',
                'recipe_id' => $faker->randomElement($uu),
            ]);
        }
    }
}
