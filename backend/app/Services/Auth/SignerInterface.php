<?php

namespace App\Services\Auth;

/**
 * Interface of Signer
 *
 * @package \App\Services\Auth
 * @author Wilton Garcia <wiltonog@gmail.com>
 **/
interface SignerInterface
{
    public function getAlgorithmId();
    public function getAlgorithm();
}
