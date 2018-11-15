<?php
namespace App\Services;

use App\Services\Search\SearchEntity;
use App\Services\Search\SearchInterface;

/**
 * Search Class
 *
 * @packaged \App\Services
 * @author Wilton Garcia <wiltonog@gmail.com>
 **/
class Search implements SearchInterface 
{
    /**
     * Adapter
     *
     * @var \App\Services\ProductAdapter
     **/
    protected $adapter;

    /**
     * Constructor
     *
     * @return void
     **/
    public function __construct(ProductAdapter $adapter){
        $this->adapter = $adapter;    
    }

    /**
     * Search
     *
     * @param \App\Services\Search\SearchEntity $entity
     *
     * @return array
     **/
    public function search(SearchEntity $entity)
    {
        $query = !empty($entity->query) ? $entity->query : '*'; 
        $search = $this->adapter->search($query);
        if (!empty($entity->filter)) {
            list($field, $value) = preg_split('/:/', $entity->filter);
            $search->where($field, $value);
        }

        $order = !empty($entity->order) ? $entity->order : '_score';
        $orderDir = !empty($entity->orderDir) ? $entity->orderDir : 'ASC';
        $perPage = !empty($entity->perPage) ? $entity->perPage : 10;
        return $search->orderBy($order, $orderDir)
            ->paginate($perPage)->toArray();
    }    
}
