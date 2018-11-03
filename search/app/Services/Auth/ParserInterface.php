<?php

namespace App\Services\Auth;

/**
 * Interface of Parser
 *
 * @package \App\Services\Auth
 * @author Wilton Garcia <wiltonog@gmail.com>
 **/
interface ParserInterface 
{
    public function parse($jwt);    
}
