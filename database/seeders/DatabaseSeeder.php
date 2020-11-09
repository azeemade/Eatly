<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(IngredientsTableSeeder::class);
        $this->call(Recipes_IngredientsTableSeeder::class);
        $this->call(MealsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RecipesTableSeeder::class);
        $this->call(ShopsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
    }
}
