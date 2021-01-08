<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\meal;
use App\Models\Shop;
use App\Models\User;
use App\Models\Cart;
use App\Models\Cart_meal;
use App\Models\Category;
use App\Models\Category_meal;
use App\Models\Comment;
use App\Models\Favourite;
use App\Models\Favourite_meal;
use App\Models\Favourite_shop;
use App\Models\Image;
use App\Models\Meal_size;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Search;
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
       // Meal_size::truncate();
       // Image::truncate();
        //  Order::truncate();
         // Category::truncate();
        // Category_meal::truncate();
        // Search::truncate();
         // Cart::truncate();
        // Cart_meal::truncate();
         //Favourite_meal::truncate();
         //Favourite::truncate();
         //Favourite_shop::truncate();
        //Rating::truncate();
          //Comment::truncate();
        Schema::enableForeignKeyConstraints();

       // $this->call(UsersTableSeeder::class);
       // \App\Models\User::factory(5)->create();
       // \App\Models\Shop::factory(5)->create();
       // $this->call(MealsTableSeeder::class);      
        //$this->call(OrdersTableSeeder::class);
       //$this->call(CartsTableSeeder::class);
      // $this->call(FavouritesTableSeeder::class);
    //  $this->call(MealSizeSeeder::class);
      //$this->call(ImageTableSeeder::class);
     //$this->call(OrdersTableSeeder::class);
    //$this->call(CategoriesTableSeeder::class);
    //$this->call(SearchTableSeeder::class);
    //$this->call(CartsTableSeeder::class);
    //$this->call(FavouritesTableSeeder::class);
        //$this->call(RatingsTableSeeder::class);
        //$this->call(ReviewsTableSeeder::class);
       
    }
}
