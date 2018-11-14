<?php
namespace App\Services;

/**
 * undocumented class
 *
 * @packaged default
 * @author yourname
 **/
class Search implements SearchInterface 
{
    public function search(SearchEntity $entity)
    {
        print_r($entity); die();       
    }    
}
