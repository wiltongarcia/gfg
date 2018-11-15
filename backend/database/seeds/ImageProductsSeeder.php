<?php

use App\Services\ProductAdapter;
use GuzzleHttp\Client;
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
            $products = (new ProductAdapter())->scroll("2m")
                 ->take(1000)
                 ->get();
            while($products->isNotEmpty()) {
                foreach ($products as $key => $product) {
                    $product->image = (($key % 62) +1).'.jpg';
                    $product->save();
                }
                $products = (new ProductAdapter())->scroll("2m")
                    ->scrollID($products->scroll_id)
                    ->get();
            }
        } catch (\Exception $e) {
            var_dump($e); die();
        }
    }
}
