<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\meal;
use App\Models\Shop;
use App\Models\User;
use App\Models\Cart;
use App\Models\Favourite;
use App\Models\Image;
use App\Models\Meal_size;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
      //  User::truncate();
       // Shop::truncate();
        // Meal::truncate();
        //Cart::truncate();
        //Favourite::truncate();
      //  Meal_size::truncate();
       // Image::truncate();
        Schema::enableForeignKeyConstraints();

       // $this->call(UsersTableSeeder::class);
       // \App\Models\User::factory(5)->create();
       // \App\Models\Shop::factory(5)->create();
       // $this->call(MealsTableSeeder::class);     
        //$this->call(CartsTableSeeder::class);
       // $this->call(BookmarksTableSeeder::class);    
       // $this->call(OrdersTableSeeder::class);
      // $this->call(CartsTableSeeder::class);
      // $this->call(FavouritesTableSeeder::class);
     // $this->call(MealSizeSeeder::class);
     // $this->call(ImageTableSeeder::class);
       
       
    }
}
