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
        $this->stock = 0;
        $this->pictures = [];
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

    /**
     * @return int
     */
    public function getCategoryId()
    {
        return $this->category->getId();
    }

    /**
     * @return string
     */
    public function getCategoryName()
    {
        return $this->category->getName();
    }

    /**
     * @return string
     */
    public function getCategoryDescription()
    {
        return $this->category->getDescription();
    }

    public function setCategory(\PDO $conn, $id)
    {
        $this->category = Category::loadCategoryById($conn, $id);
    }

    public function addToStock($quantity)
    {
        if (is_int($quantity)) {
            $this->stock += $quantity;
        }
    }

    public function removeFromStock($quantity)
    {
        if (is_int($quantity)) {
            $this->stock -= $quantity;
            if ($this->stock < 0) {
                $this->stock = 0;
            }
        }
    }

    public function saveDB(\PDO $conn)
    {
        {
            if (-1 === $this->id) {
                $sql = $conn->prepare("INSERT INTO `product` (`name`, `description`, `stock`, `price`, `category_id`) VALUES (?, ?, ?, ?, ?);");
                $result = $sql->execute([$this->name, $this->description, $this->stock, $this->price, $this->getCategoryId()]);

                if($result) {
                    $this->id = $conn->lastInsertId();
                    return true;
                }
                return false;
            } else {
                $sql = sprintf("UPDATE product SET name='%s', description='%s', stock=%d, price=%f, category_id=%d WHERE id='%d'",
                    $this->name, $this->description, $this->stock, $this->price, $this->category
                );
                $result = $conn->query($sql);

                if ($result) {
                    return true;
                }
                return false;
            }
        }
    }

    public function delete(mysqli $conn)
    {

    }

    static public function loadProductByName(mysqli $conn, $name)
    {

    }

    static public function loadProductById(\PDO $conn, $id)
    {
        $sql = sprintf("SELECT * FROM product WHERE id=%d", $id);
        $result = $conn->query($sql);

        if(!$result) {
            die ("Query error: " . $conn->connect_errno . ", " . $conn->error);
        }

        if ($result->rowCount()) {
            $prodArray = $result->fetch();
            $product = new Product();

            $product->id = $prodArray['id'];
            $product->name = $prodArray['name'];
            $product->description = $prodArray['description'];
            $product->stock = $prodArray['stock'];
            $product->price = $prodArray['price'];
            $product->category = Category::loadCategoryById($conn, $prodArray['category_id']);

            return $product;
        } else {
            return false;
        }
    }

    static public function loadAllProducts(mysqli $conn)
    {

    }

}