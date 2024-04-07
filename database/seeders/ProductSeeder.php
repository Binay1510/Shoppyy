<?php

namespace Database\Seeders;

use App\Models\Brands;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker; 
use App\Models\Product;
use Illuminate\Support\Facades\Config;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();   
        foreach (range(1,10) as $value) {
        Product::create([
            'name'=>$faker->randomElement(Brands::pluck('name')).'watch',
            'price'=>$faker->numberBetween($min=500,$max=1000),	
            'sale_price'=>$faker->numberBetween($min=50,$max= 500),
            'color'=>$faker->randomElement(['gold','silver','black','rose gold','beige']),
            'brand_id'=>$faker->randomElement(Brands::pluck('id')),
            'product_code'=>$faker->numerify('LV=####')	,
            'gender'=>$faker->randomElement(['male','female','children']),
            'function'=>$faker->randomElement(Config::get('watch_funcitons')),
            'stock'=>$faker->randomDigit()	,
            'description'=>$faker->text($maxNBChars=200)	,
            'image'=>$faker->imageUrl($width=640,$height=480)	,
            'is-active'=>$faker->randomElement(['1','0']),

        ]  );
        }
    }
}
