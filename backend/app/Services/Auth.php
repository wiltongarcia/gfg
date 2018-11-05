<?php 

namespace App\Services;

use App\Services\Auth\ParserInterface;
use App\Services\Auth\SignerInterface;
use App\Services\Auth\ValidatorInterface;
use Illuminate\Http\Request;

/**
 * Authentication using JWT
 *
 * @package \App\Services\Auth
 * @author Wilton Garcia <wiltonog@gmail.com>
 **/
class Auth 
{
    /**
     * JWT Parser
     *
     * @var \App\Services\Auth\Parser
     **/
    protected $parser;

    /**
     * JWT Validator
     *
     * @var \App\Services\Auth\Validator
     **/
    protected $validator;

    /**
     * JWT Signer
     *
     * @var \App\Services\Auth\Signer
     **/
    protected $signer;

    /**
     * JWT secret key
     *
     * @var string
     **/
    protected $secret;
        
    /**
     * Create a new Auth instance
     *
     * @param \App\Services\Auth\ParserInterface    $parser
     * @param \App\Services\Auth\ValidatorInterface $validator
     * @param \App\Services\Auth\SignerInterface    $signer
     * @param string                                $secret
     *
     * @return void
     **/
    function __construct(ParserInterface $parser, 
        ValidatorInterface $validator,  
        SignerInterface $signer,
        string $secret
    )
    {
        $this->parser = $parser;
        $this->signer = $signer;
        $this->validator = $validator;
        $this->secret = $secret;
    }        

    /**
     * Validate if has a correct token
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     **/
    public function validate(Request $request)
    {
        try {
            $authHeader = $request->headers->get("Authorization");

            // Validate if Authorization Header is empty
            if (empty($authHeader)) {
                return false;
            }

            $splited = explode(" ", $authHeader);

            // Validate if pattern "Bearer [token]" is not matched
            if (count($splited) < 2 || count($splited) > 2) {
                return false;
            }

            // Parse the token string
            $token = $this->parser->parse($splited[1]);
            if (empty($token)) {
                return false;
            }

            // Verify if the token is valid and signed correctly 
            return $token->validate($this->validator) &&
                $token->verify($this->signer, $this->secret);
        } catch (\Exception $e) {
            return false;
        }
    }
}
