<?php

namespace Database\Factories;

/** @var  \Illuminate\Database\Eloquent\Factories\Factory $factory */
use App\Models\Shop;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shop::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();
        return [
            'shop_name' => $faker->word(),
            'shop_image' => 'Shop',
            'shop_description' => $faker->sentence(),
            'shop_vendor_id' => $this->getUser(),
            'open_time' => $faker->time(),
            'close_time' => $faker->time(),
        ];
    }

    private function getUser(){
        $user = \App\Models\User::where('hasShop', '=', 'Yes')->get();
        foreach($user as $user){
            return $user->id;
        }
    }
}

