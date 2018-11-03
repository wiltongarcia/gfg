<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller of Products
 *
 * @package App\Http\Controllers
 * @author Wilton Garcia <wiltonog@gmail.com>
**/
class ProductController extends Controller
{
    /**
     * Endpoint to search products
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     **/
    public function index(Request $request)
    {
       return response()->json([
           'data' => [
               [
                   'title' => 'title',
                   'brand' => 'brand',
                   'price' => 0.0,
                   'stock' => 0
               ]
           ]
       ]); 
    }
}
