<?php

namespace App\Services\Auth;

/**
 * Interface of Validator
 *
 * @package \App\Services\Auth
 * @author Wilton Garcia <wiltonog@gmail.com>
 **/
interface ValidatorInterface
{
    public function setId($id);
    public function setIssuer($issuer);
    public function setAudience($audience);
    public function setSubject($subject);
    public function setCurrentTime($currentTime);
}
