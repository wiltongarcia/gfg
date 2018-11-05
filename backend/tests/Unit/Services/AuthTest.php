<?php
namespace Tests\Unit\Services;

use App\Services\Auth\Signer;
use Lcobucci\JWT\Builder;
use Tests\TestCase;


/**
 * Test Case of Authenticationh
 *
 * @package \Tests\Unit\Services
 * @author Wilton Garcia <wiltonog@gmail.com>
 **/
class AuthTest extends TestCase 
{
    /**
     * Test of Authentication
     *
     * @param bool                  $expected
     * @param array                 $headers
     * @param \Lcobucci\JWT\Token   $token
     * @param bool                  $isValid
     *
     * @return void
     *
     * @group unit
     *
     * @dataProvider getDataProvider
     *
     **/
    public function testAuth($expected, $headers, $token, $isValid)
    {
        $auth = $this->getAuth($token, $isValid);

        $request = $this->getRequest($headers);

        $this->assertEquals(
            $expected, 
            $auth->validate($request)
        );
    }

    /**
     * Return a list to run all tests
     *
     * @return array
     **/
    public function getDataProvider()
    {
        return [
            [
                false,
                [],
                null,
                false
            ],
            [
                false,
                ['HTTP_Authorization' => 'xxx'],
                null,
                false
            ],
            [
                false,
                ['HTTP_Authorization' => 'Bearer xxx'],
                null,
                false
            ],
            [
                false,
                ['HTTP_Authorization' => 'Bearer xxx'],
                $this->getToken(false),
                false
            ],
            [
                false,
                ['HTTP_Authorization' => 'Bearer xxx.xxx.xxx'],
                $this->getTokenWithException(),
                false
            ],
            [
                true,
                ['HTTP_Authorization' => 'Bearer xxx.xxx.xxx'],
                $this->getToken(true),
                true
            ],
        ];
    }

    /**
     * Return a Request Mock
     *
     * @param array $headers
     *
     * @return \Illuminate\Http\Request
     **/
    private function getRequest(array $headers)
    {
        return  new \Illuminate\Http\Request(
            [],
            [],
            [],
            [],
            [],
            $headers
        );
    }

    /**
     * Create a Auth instance
     *
     * @param \Lcobucci\JWT\Token   $token
     * @param bool                  $isValid
     *
     * @return \App\Services\Auth
     **/
    private function getAuth($token, $isValid)
    {
        // Parser Mock
        $parser = $this->getMockBuilder('App\Services\Auth\Parser')
            ->setMethods(['parse'])
            ->getMock();

        $parser->expects($this->any())
            ->method('parse')
            ->will($this->returnValue($token));

        // Validator Mock
        $validator = $this->getMockBuilder('App\Services\Auth\Validator')
            ->setMethods(['validate'])
            ->getMock();

        $validator->expects($this->any())
            ->method('validate')
            ->will($this->returnValue($isValid));

        // Signer Mock
        $signer = $this->getMockBuilder('App\Services\Auth\Signer')
            ->getMock();

        return new \App\Services\Auth(
            $parser, 
            $validator, 
            $signer, 
            'secret'
        );
    }

    /**
     * Return mock of Token
     *
     * @param bool $isVerified
     *
     * @return \Lcobucci\JWT\Token
     **/
    private function getToken($isVerified)
    {
        $token = $this->getMockBuilder('Lcobucci\JWT\Token') 
            ->setMethods(['verify'])
            ->getMock();

        $token->expects($this->any())
            ->method('verify')
            ->will($this->returnValue($isVerified));

        return $token;
    }   

    /**
     * Return mock of Token for simulate a Exception
     *
     * @return \Lcobucci\JWT\Token
     **/
    private function getTokenWithException()
    {
        $token = $this->getMockBuilder('Lcobucci\JWT\Token') 
            ->setMethods(['verify'])
            ->getMock();

        $token->expects($this->any())
            ->method('verify')
            ->will($this->returnCallback(function ($data) {
                throw new \Exception();   
            }));

        return $token;
    }  
}
