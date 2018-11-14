<?php

/**
 * undocumented class
 *
 * @packaged default
 * @author yourname
 **/
class SearchEntity
{
    public $query;
    public $filter;
    public $order;
    public $orderDir;
    public $perPage;

    /**
     * undocumented function
     *
     * @return void
     * @author yourname
     **/
    public function __construct(array $attributes)
    {
        foreach ($attributes as $attribute => $value) {
            $this->{$attribute} = $value;
        }
    }
}
