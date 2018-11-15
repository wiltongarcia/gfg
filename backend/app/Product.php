<?php

namespace App;

class Product implements \JsonSerializable
{
    /**
     * Title
     *
     * @var string
     **/
    private $title;

    /**
     * Brand
     *
     * @var string
     **/
    private $brand;

    /**
     * Price
     *
     * @var float
     **/
    private $price;

    /**
     * Stock
     *
     * @var integer
     **/
    private $stock;

    /**
     * Date
     *
     * @var \DateTime
     **/
    private $date;

    /**
     * Constructor
     *
     * @return void
     **/
    public function __construct($title, $brand, $price, $stock, $image)
    {
        $this->title = $title;
        $this->brand = $brand;
        $this->price = $price;
        $this->stock = $stock;
        $this->image = $image;
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
     * Get Image
     *
     * @return string
     **/
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Get Date
     *
     * @return \DateTime
     **/
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Return a array to convert to json
     *
     * @return array
     **/
    public function jsonSerialize()
    {
        return [
            'title' => $this->getTitle(),
            'brand' => $this->getBrand(),
            'price' => $this->getPrice(),
            'stock' => $this->getStock(),
            'image' => $this->getImage(),
            'date' => $this->getDate()->format('Y-m-d H:i:s')
        ];
    }
}
