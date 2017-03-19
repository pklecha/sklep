<?php

/**
 * Created by PhpStorm.
 * User: pawel
 * Date: 19.03.17
 * Time: 13:31
 */
class Product
{
    private $name;
    private $price;
    private $decription;
    private $stock;
    private $pictures;

    public function getPictures()
    {
        // 
    }

    public function addPicture()
    {
        
    }
    
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getDecription()
    {
        return $this->decription;
    }

    /**
     * @param mixed $decription
     */
    public function setDecription($decription)
    {
        $this->decription = $decription;
    }

    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param mixed $stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function addToStock($quantity)
    {
        $this->stock += $quantity;
    }

    public function removefromStock($quantity)
    {
        $this->stock -= $quantity;
    }

    public function saveDB()
    {
        
    }

}