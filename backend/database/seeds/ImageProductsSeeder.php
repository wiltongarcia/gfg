<?php

use Illuminate\Database\Seeder;

class ImageProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try{
            $products = (new App\Product())->all();
            foreach ($products as $key => $product) {
                //var_dump($product->_id); die();
                App\Product::id($product->_id)->update([
                    'image' => (($key % 62) +1).".jpg"
                ]);
            }
        } catch (\Exception $e) {
            var_dump($e->getMessage()); die();
        }
    }
}
