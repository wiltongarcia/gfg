<?php
namespace App\Services;

use App\Product;


/**
 * Product Factory
 *
 * @package \App\Services
 * @author Wilton Garcia <wiltonog@gmail.com>
 **/
class ProductFactory 
{
    /**
     * Create a Product
     *
     * @return \App\Product
     **/
    public static function create(array $attributes)
    {
        return new Product($attributes['title'], 
            $attributes['brand'], 
            $attributes['price'], 
            $attributes['stock'],
            $attributes['image']
        );
    }    
}
