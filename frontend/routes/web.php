<?php

use GuzzleHttp\Client;
use Illuminate\Http\Request;

$router->get('/healthcheck', function(){
    return 'OK';
});

$router->get('/', ['as' => 'home', function (Request $request) use ($router) {

    // Make the queryString to Products API
    $queryString = $request->getQueryString();
    $search = config('products.endpoint');
    if (!empty($queryString)) {
        $search .= '?' . $queryString;
    }

    // Request Products
    $client = new Client([
        'base_uri' => config('products.base_uri'),
        'timeout'  => 30,
    ]);

    $response = $client->request('GET',
        $search,
        [
            'headers' => ['Authorization' => 'Bearer ' .  config('products.token')]
        ]
    );

    // JSON response
    $data = json_decode($response->getBody());
    var_dump($data); die();

    // Remove the path of the URLs
    $data->next_page_url = preg_replace(
        "/^(.*)\?(.*)$/",
        "/?$2",
        $data->next_page_url
    );

    $data->prev_page_url = preg_replace(
        "/^(.*)\?(.*)$/",
        "/?$2",
        $data->prev_page_url
    );

    $query = $request->query();

    // When the brand filter is applied on a page number greather than total
    if (!empty($query['page']) && $query['page'] > $data->total) {
        return redirect()->route('home', array_merge($query, ['page' => 1]));
    }

    return view('home', [
        'response' => $data,
        'query' =>  $query
    ]);
}]);
