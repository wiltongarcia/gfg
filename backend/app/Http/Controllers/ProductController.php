<?php

namespace App\Http\Controllers;

use App\Services\ProductAdapter;
use App\Services\ProductFactory;
use App\Services\Search;
use App\Services\Search\SearchEntity;
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
        $searchService = new Search(new ProductAdapter());

        $searchEntity = new SearchEntity([
            'query' => $request->get('q'),
            'filter' => $request->get('filter'),
            'order' => $request->get('order'),
            'orderDir' => $request->get('orderDir'),
            'perPage' => $request->get('perPage')
        ]);

        $searchData = $searchService->search($searchEntity);

        $products = [];
        foreach ($searchData['data'] as $attributes) {
            $products[] = ProductFactory::create($attributes);
        }

        return response()->json([
            'prev_page_url' => $searchData['prev_page_url'],
            'next_page_url' => $searchData['next_page_url'],
            'current_page' => $searchData['current_page'],
            'total' => $searchData['total'],
            'last_page' => $searchData['last_page'],
            'data' => $products
        ]); 
    }
}
