<?php
namespace App\Services\Search;

/**
 * Search Interface
 *
 * @package \App\Services\Search
 * @author Wilton Garcia <wiltonog@gmail.com>
 **/
interface SearchInterface
{
    public function search(SearchEntity $entity);    
}
