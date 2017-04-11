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
    private $photos;
    private $category_id;

    public function __construct()
    {
        $this->id = -1;
        $this->name = '';
        $this->price = '';
        $this->description = '';
        $this->stock = 0;
        $this->photos = [];
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param int $stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    /**
     * @param array $photos
     */
    public function setPhotos($photos)
    {
        $this->photos = $photos;
    }

    /**
     * @param mixed $category_id
     */
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    /**
     * @return array
     */
    public function getAllPhotos()
    {
        return $this->photos;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getPhotoById($id)
    {
        return $this->photos[$id];
    }



    #region oldCode
//    public function setPhotos(\PDO $conn)
//    {
//        $this->photos = Photo::loadPhotosByProductId($conn, $this->id);
//    }
//
//    public function getPhotosIds()
//    {
//        $photosIds = [];
//        foreach ($this->photos as $key => $value) {
//            $photosIds[] = $key;
//        }
//        return $photosIds;
//    }
//
//    public function getPhotoPath($id)
//    {
//        if (key_exists($id, $this->photos)) {
//            return $this->photos[$id]->getPath();
//        }
//        return false;
//    }
//
//    public function addPhoto(\PDO $conn, $photoId)
//    {
//        if (Photo::loadPhotoById($conn, $photoId)) {
//            $this->photos[$photoId] = Photo::loadPhotoById($conn, $photoId);
//        }
//    }
//
//    public function deletePhoto($pictureId)
//    {
//        if (key_exists($pictureId,$this->photos)) {
//            unset($this->photos[$pictureId]);
//            return true;
//        }
//        return false;
//    }
//
//    /**
//     * @return int
//     */
//    public function getId()
//    {
//        return $this->id;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getName()
//    {
//        return $this->name;
//    }
//
//    /**
//     * @param mixed $name
//     */
//    public function setName($name)
//    {
//        $this->name = $name;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getPrice()
//    {
//        return $this->price;
//    }
//
//    /**
//     * @param mixed $price
//     */
//    public function setPrice($price)
//    {
//        $this->price = $price;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getDescription()
//    {
//        return $this->description;
//    }
//
//    /**
//     * @param mixed $description
//     */
//    public function setDescription($description)
//    {
//        $this->description = $description;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getStock()
//    {
//        return $this->stock;
//    }
//
//    /**
//     * @param mixed $stock
//     */
//    public function setStock($stock)
//    {
//        $this->stock = $stock;
//    }
//
//    /**
//     * @return int
//     */
//    public function getCategoryId()
//    {
//        return $this->category->getId();
//    }
//
//    /**
//     * @return string
//     */
//    public function getCategoryName()
//    {
//        return $this->category->getName();
//    }
//
//    /**
//     * @return string
//     */
//    public function getCategoryDescription()
//    {
//        return $this->category->getDescription();
//    }
//
//    public function setCategory(\PDO $conn, $id)
//    {
//        $this->category = Category::loadCategoryById($conn, $id);
//    }
//
//    public function addToStock($quantity)
//    {
//        if (is_int($quantity)) {
//            $this->stock += $quantity;
//        }
//    }
//
//    public function removeFromStock($quantity)
//    {
//        if (is_int($quantity)) {
//            $this->stock -= $quantity;
//            if ($this->stock < 0) {
//                $this->stock = 0;
//            }
//        }
//    }
//
//    public function saveDB(\PDO $conn)
//    {
//        if (-1 === $this->id) {
//            $sql = $conn->prepare("INSERT INTO `product` (`name`, `description`, `stock`, `price`, `category_id`) VALUES (?, ?, ?, ?, ?);");
//            $result = $sql->execute([$this->name, $this->description, $this->stock, $this->price, $this->getCategoryId()]);
//
//            if($result) {
//                $this->id = $conn->lastInsertId();
//                return true;
//            }
//            return false;
//        } else {
//            $sql = $conn->prepare("UPDATE product SET name=?, description=?, stock=?, price=?, category_id=? WHERE id=?");
//            $result = $sql->execute([$this->name, $this->description, $this->stock, $this->price, $this->getCategoryId(), $this->id]);
//
//            if ($result) {
//                return true;
//            }
//            return false;
//        }
//    }
//
//    public function delete(\PDO $conn)
//    {
//        if ($this->id != -1) {
//            $sql = $conn->prepare("DELETE FROM product WHERE id=?");
//            $result = $sql->execute([$this->id]);
//            if ($result) {
//                $this->id = -1;
//                return true;
//            }
//            return false;
//        }
//        return true;
//    }
//
//    static public function loadProductByName(\PDO $conn, $name)
//    {
//        $result = $conn->query("SELECT * FROM product WHERE name LIKE \"" . $name . "%\"");
//        if(!$result) {
//            die ("Query error: " . $conn->errorCode() . ", " . $conn->errorInfo());
//        }
//
//        if ($result->rowCount()) {
//            $prodArray = $result->fetch();
//            $product = new Product();
//
//            $product->id = $prodArray['id'];
//            $product->name = $prodArray['name'];
//            $product->description = $prodArray['description'];
//            $product->stock = $prodArray['stock'];
//            $product->price = $prodArray['price'];
//            $product->category = Category::loadCategoryById($conn, $prodArray['category_id']);
//
//            return $product;
//        } else {
//            return false;
//        }
//    }
//
//    static public function loadProductById(\PDO $conn, $id)
//    {
//        $result = $conn->query("SELECT * FROM product WHERE id=" . $id);
//        if(!$result) {
//            die ("Query error: " . $conn->errorCode() . ", " . $conn->errorInfo());
//        }
//
//        if ($result->rowCount()) {
//            $prodArray = $result->fetch();
//            $product = new Product();
//
//            $product->id = $prodArray['id'];
//            $product->name = $prodArray['name'];
//            $product->description = $prodArray['description'];
//            $product->stock = $prodArray['stock'];
//            $product->price = $prodArray['price'];
//            $product->category = Category::loadCategoryById($conn, $prodArray['category_id']);
//            $product->photos = Photo::loadPhotosByProductId($conn, $prodArray['id']);
//
//            return $product;
//        } else {
//            return false;
//        }
//    }
//
//    static public function loadAllProducts(\PDO $conn)
//    {
//        $allProducts = [];
//        $result = $conn->query("SELECT * FROM product");
//        if ($result->rowCount() > 0) {
//            while ($prodArray = $result->fetch(PDO::FETCH_ASSOC)) {
//                $product = new Product();
//
//                $product->id = $prodArray['id'];
//                $product->name = $prodArray['name'];
//                $product->description = $prodArray['description'];
//                $product->stock = $prodArray['stock'];
//                $product->price = $prodArray['price'];
//                $product->category = Category::loadCategoryById($conn, $prodArray['category_id']);
//
//                $allProducts[] = $product;
//            }
//            return $allProducts;
//        } else {
//            return false;
//        }
//    }
    #endregion



}