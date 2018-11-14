<?php

namespace App\Http\Controllers;

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
        $query = $request->get('q', '*');
        $filter = $request->get('filter');
        $fields = $request->get('fields');
        $order = $request->get('order', '_score');
        $orderDir = $request->get('orderDir', 'asc');
        $perPage = $request->get('perPage', 10);


        $searchEntity = new SearchEntity([
            'query' => $query,
            'filter' => $filter,
            'order' => $order,
            'orderDir' => $orderDir,
            'perPage' => $perPage
        ]);

        $searchList = $searchService->search($searchEntity);


        $search = \App\Product::search($query);

        if (!empty($filter)) {
            list($field, $value) = preg_split('/:/', $filter);
            $search->where($field, $value);
        }

        $products = $search->orderBy($order, $orderDir)
            ->paginate($perPage);

        return response()->json($products); 
    }
}
