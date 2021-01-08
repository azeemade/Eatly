<?php

namespace Database\Seeders;

use App\Models\meal;
use App\Models\Order;
use App\Models\Shop;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
       // $uu = meal::pluck('id')->toArray();
       // $vv = User::where('role', '=', 'consumer')->pluck('id')->toArray();
        //$ww = Shop::all()->pluck('id')->first();
       // $yy = meal::where('vendor_id', '=', $ww)->toArray();

        for($i = 0; $i < 30; $i++){
            $vendor_id = $this->getVendor();
            $payType = $this->getpayType();
            $meal_id = $this->getMeal($vendor_id);
            $delivery = $faker->boolean();

            if ($payType == 'credit-card'){
                $nameOnCard = $faker->firstName().' '.$faker->lastName();
                $cardNumber = $faker->creditCardNumber();
                $cardExpiration = $faker->creditCardExpirationDateString;
                $ccv = $faker->creditCardNumber();
                $cardType = $faker->creditCardType;
            }else{
                $nameOnCard = '';
                $cardNumber = '';
                $cardExpiration = '';
                $ccv = '';
                $cardType = '';
            }

            Order::create([
                'shop_id' => $vendor_id,
                'meal_id' => $meal_id,
                'user_id' => $this->getUser(),
                'quantity' => $faker->numberBetween($min =1, $max = 50),
                'meal_size_id' => $this->getMealSize($meal_id),
                'shippingAddress' => $faker->streetAddress,
                'billingAddress' => $faker->streetAddress,
                'order_status' => $this->getStatus($delivery),
                'paymentType' => $payType,
                'cardType' => $cardType,
                'nameOnCard' => $nameOnCard,
                'cardNumber' => $cardNumber,
                'cardExpiration' => $cardExpiration,
                'ccv' => $ccv,
                'is_delivered' => $delivery
            ]);
        }
    }

    private function getUser(){
        $user = \App\Models\User::inRandomOrder()->where('role', '=', 'user')->where('hasShop', 'No')->first();
        return $user->id;
    }
    private function getMeal($vendor_id){
        $meal = \App\Models\meal::inRandomOrder()->where('shop_id', '=', $vendor_id)->where('meal_approval', 'active')->first();
        return $meal->id;
    }
    private function getVendor(){
        $shop = \App\Models\Shop::inRandomOrder()->first();        
        return $shop->id;
    }

    private function getpayType(){
        $payType = ["credit-card", "bank-transfer"];
        $payType_ = array_rand($payType);
        return $payType[$payType_];
    }

    private function getMealSize($meal_id){
        $meal_size = \App\Models\Meal_size::inRandomOrder()->where('meal_id', '=', $meal_id)->first();
        return $meal_size->id;
    }

    private function getStatus($delivery){
        if ($delivery == true){
            return 'delivered';
        }else{
            $status = ['delivery not started', 'delivery in progress'];
            $status_ = array_rand($status);
            return $status[$status_];
        }
    }
}
