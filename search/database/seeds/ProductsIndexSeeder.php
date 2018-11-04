<?php

use Illuminate\Database\Seeder;

class ProductsIndexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try{
            $faker = Faker\Factory::create();

            $companies = [
                'Young&Teen Tops',
                '23/10 Clothing',
                '23TEN',
                '23 Clothiers & Co.',
                'Vivacious Tops',
                'Factory10',
                'Youth23',
                'Youth Clothiers',
                'Cloth & Stitch Co.',
                'Mad Stitches',
                'Youthful Threads',
                'Twisted Stitchers',
                'Golden Elegance',
                'Fine Threads',
                'Silk & Spool Clothing',
                'TopTen Clothing',
                '23Threads',
                'Young & Thimble',
                'Wild & Free Clothing',
                'Young Value Co.' 
            ];

            for($i = 0; $i < 1000; $i++) {
                $product = new App\Product();
                $product->title = $faker->text(30);
                $product->brand = $companies[$i % (count($companies) - 1)];
                $product->price = $faker->randomFloat(2);
                $product->stock = $faker->randomDigit;
                $product->save();
            }
        } catch (\Exception $e) {
         var_dump($e); die();
        }
    }
}
