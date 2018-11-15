<?php
namespace App\Services\Search;

/**
 * Search Entity
 *
 * @package \App\Services\Search
 * @author Wilton Garcia <wiltonog@gmail.com>
 **/
class SearchEntity
{
    public $query;
    public $filter;
    public $order;
    public $orderDir;
    public $perPage;

    /**
     * Constructor
     *
     * @return void
     **/
    public function __construct(array $attributes)
    {
        foreach ($attributes as $attribute => $value) {
            $this->{$attribute} = $value;
        }
    }
}
