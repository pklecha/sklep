<?php

/**
 * Created by PhpStorm.
 * User: pawel
 * Date: 19.03.17
 * Time: 13:31
 */
class Product
{
    private $id;
    private $name;
    private $price;
    private $description;
    private $stock;
    private $pictures;
    private $category;

    public function __construct()
    {
        $this->id = -1;
        $this->name = '';
        $this->price = '';
        $this->description = '';
        $this->pictures = [];
        $this->category = '';
    }

    public function getAllPictures()
    {
        // 
    }

    public function getPictureById($pictureId)
    {

    }

    public function addPicture()
    {
        
    }

    public function deletePicture($pictureId)
    {

    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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

    public function removeFromStock($quantity)
    {
        $this->stock -= $quantity;
    }

    public function saveDB(mysqli $conn)
    {

    }

    public function delete(mysqli $conn)
    {

    }

    static public function loadProductByName(mysqli $conn, $name)
    {

    }

    static public function loadProductById(mysqli $conn, $id)
    {

    }

    static public function loadAllProducts(mysqli $conn)
    {

    }

}