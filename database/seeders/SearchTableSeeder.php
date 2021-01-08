<?php

namespace Database\Seeders;

use App\Models\Search;
use Illuminate\Database\Seeder;

class SearchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for($i = 0; $i < 75; $i++){
            Search::create([
                'search_title' => $faker->word(),
                'user_id' => $this->getUser(),
                'created_at' => $faker->dateTimeBetween($startDate = '-6 months', $endDate = '+7 months')
            ]);
        }
    }

    private function getUser(){
        $user = \App\Models\User::where('role', '!=', 'admin')->inRandomOrder()->first();
        return $user->id;
    }
}
