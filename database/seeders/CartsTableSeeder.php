<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = \Faker\Factory::create();

        for($i = 0; $i < 10; $i++){
            Cart::create([
                'user_id' => $this->getUser(),
            ]);
        }
    }

    private function getUser(){
       // $user = DB::table('users')->where('role', '!=', 'admin')->pluck('id')->toArray();
      // $user = \App\Models\User::pluck('id')->toArray();
        $user = \App\Models\User::where('role', '!=', 'admin')->first();
        return $user->id;
    }
}
