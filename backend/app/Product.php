<?php

namespace App;

use App\Services\Search\SearchModelInterface;

class Product implements SearchModelInterface 
{
    private $title;

    private $brand;

    private $price;

    private $stock;

    private $date;

    /**
     * Constructor
     *
     * @return void
     **/
    public function __construct($title, $brand, $price, $stock)
    {
        $this->title = $title;
        $this->brand = $brand;
        $this->price = $price;
        $this->stock = $stock;
        $this->date = new \DateTime('NOW');    
    }

    /**
     * Get Title
     *
     * @return string
     **/
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get Brand
     *
     * @return string
     **/
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Get price
     *
     * @return float
     **/
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Get Stock
     *
     * @return integer
     **/
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Get Date
     *
     * @return string
     **/
    public function getDate()
    {
        return $this->date;
    }
}
