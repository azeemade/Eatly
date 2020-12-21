<?php

namespace Database\Factories;

/** @var  \Illuminate\Database\Eloquent\Factories\Factory $factory */
use App\Models\Meal;
use App\Models\Shop;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

//$factory->define(meal::class, function(Faker $faker){
//    return [
 //       'meal_name' => $faker->words(),
 //       'meal_price' => $faker->randomNumber(4),
 //       'meal_slug' => $faker->slug(),
//        'meal_additional_text' => $faker->sentences(),
//        'user_id' => \App\Models\User::factory()->create()->id,
 //       'vendor_id' => \App\Models\Shop::factory()->create()->id,
 //   ];
//});

class MealFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = meal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
    }
}

