<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * undocumented function
     *
     * @return void
     * @author yourname
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
