<?php

namespace App\Services\Search;

/**
 * undocumented class
 *
 * @package default
 * @author yourname
 **/
interface SearchModelInterface 
{
    public function getTitle();
    public function getBrand();
    public function getPrice();
    public function getStock();
    public function getDate();
}
