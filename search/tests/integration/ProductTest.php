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
        $response = $this->json('GET', '/products', [], ['Authorization' => 'Bearer ' . $token]);

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
