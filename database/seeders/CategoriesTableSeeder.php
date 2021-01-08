<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Category_meal;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Category =['Rice-based', 'Beans-based', 'Soups & stews', 'Meats', 'Beverages', 'Side-dishes', 'Porridges', 'Swallows', 'Snacks'];
        foreach($Category as $Category){
            Category::create([
                'title' => $Category,            
            ]);
        }


        for($i = 0; $i < 30; $i++){
            Category_meal::create([
                'meal_id' => $this->getMealId(),
                'Category_id' => $this->getCategoryId(),
            ]);
        }
    }

    private function getMealId(){
        $meal = \App\Models\meal::inRandomOrder()->first();
        return $meal->id;
    }

    private function getCategoryId(){
        $cat = \App\Models\Category::inRandomOrder()->first();
        return $cat->id;
    }
}
