<?php

namespace Database\Factories;

/** @var  \Illuminate\Database\Eloquent\Factories\Factory $factory */
 
use App\Models\User;
use App\Models\meal;
use App\Models\Shop;
use App\Models\Cart;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use App\Models\Favourite;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $password = Hash::make('secret123');
        $faker = \Faker\Factory::create();
        return [
            'firstname' => $faker->firstName,
            'lastname' => $faker->lastName,
            'username' => $faker->userName,
            'phoneNumber' => $faker->unique()->phoneNumber,
            'email' => $faker->email,
            'hasShop' => 'Yes',
            'password' => $password,
            'user_image' => 'vendor'
        ];
    }
}
