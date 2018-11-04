<?php
namespace Tests\Integration;

use Tests\TestCase;

use App\Services\Auth\Signer;
use Lcobucci\JWT\Builder;

/**
 * Integration Tests
 *
 * @package Tests\Integration
 * @author Wilton Garcia <wiltonog@gmail.com>
**/
class ProductTest extends TestCase
{
    /**
     * Test of Products endpoint without errors
     *
     * @return void
     *
     * @group integration
     */
    public function testGetProducts()
    {
        $token = $this->getToken();
        $response = $this->json('GET', 
            '/products', [], 
            [
                'Authorization' => 'Bearer ' . $token,
            ]
        );

        $response
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'total',
                'current_page',
                'last_page_url',
                'next_page_url',
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

    /**
     * Test of Products endpoint with brand filter
     *
     * @return void
     *
     * @group integration
     */
    public function testGetProductsWithBrandFilter()
    {
        $token = $this->getToken();
        $response = $this->json('GET', 
            '/products?filter=brand:Factory10', [], 
            [
                'Authorization' => 'Bearer ' . $token,
            ]
        );

        $response
            ->seeStatusCode(200)
            ->seeJson([
                'brand' => 'Factory10',
            ])
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

    /**
     * Test of Products endpoint using a search term
     *
     * @return void
     *
     * @group integration
     */
    public function testGetProductsWithSearch()
    {
        $token = $this->getToken();
        $response = $this->json('GET', 
            '/products?q=et', [], 
            [
                'Authorization' => 'Bearer ' . $token,
            ]
        );

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

    /**
     * Test of Products endpoint with per page value
     *
     * @return void
     *
     * @group integration
     */
    public function testGetProductsWithPerPage()
    {
        $token = $this->getToken();
        $response = $this->json('GET', 
            '/products?perPage=100', [], 
            [
                'Authorization' => 'Bearer ' . $token,
            ]
        );

        $data = json_decode($response->response->getContent());

        $this->assertEquals(100, count($data->data));

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

    /**
     * Test Without Authorization Header
     *
     * @return void
     *
     * @group integration
     */
    public function testGetProductsWithoutToken()
    {
        $response = $this->get('/products', []);
        $response->seeStatusCode(401);
    }


    /**
     * Create a token
     *
     * @return string
     **/
    private function getToken()
    {         
        return(new Builder())
            ->sign(new Signer(), config('jwt.secret'))
            ->getToken();
    }
}
