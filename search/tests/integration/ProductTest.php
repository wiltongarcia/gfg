<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ProductTest extends Laravel\Lumen\Testing\TestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../../bootstrap/app.php';
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetProducts()
    {
        $response = $this->json('GET', '/products', []);

        $response
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'data' => [
                    '*' => [
                        'title',
                        'brand',
                        'price',
                        'stock'
                    ]
                ]
            ]);
    }
}
