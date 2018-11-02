<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetProduct()
    {
        $this->get('/products');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }
}
