<?php

/**
 * Created by PhpStorm.
 * User: pawel
 * Date: 24.03.17
 * Time: 23:32
 */
class Photo
{
    private $id;
    private $path;
    private $product_id;

    public function __construct()
    {
        $this->id = -1;
        $this->path = '';
        $this->product_id = -1;
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
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return int
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @param int $product_id
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }



    public function savePhoto(\PDO $conn)
    {
        if (-1 === $this->id) {
            $sql = $conn->prepare("INSERT INTO `photo` (`name`, `description`, `stock`, `price`, `category_id`) VALUES (?, ?, ?, ?, ?);");
            $result = $sql->execute([$this->name, $this->description, $this->stock, $this->price, $this->getCategoryId()]);

            if($result) {
                $this->id = $conn->lastInsertId();
                return true;
            }
            return false;
        } else {
            $sql = $conn->prepare("UPDATE product SET name=?, description=?, stock=?, price=?, category_id=? WHERE id=?");
            $result = $sql->execute([$this->name, $this->description, $this->stock, $this->price, $this->getCategoryId(), $this->id]);

            if ($result) {
                return true;
            }
            return false;
        }
    }

    public function delete(\PDO $conn) {
        if ($this->id != -1) {
            $sql = $conn->prepare("DELETE FROM photo WHERE id=?");
            $result = $sql->execute([$this->id]);
            if ($result) {
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }

    static public function loadPhotoById(\PDO $conn, $id)
    {
        $sql = sprintf("SELECT * FROM `photo` WHERE id = %d", $id);

        $result = $conn->query($sql);

        if (!$result) {
            die('Query error: ' . $conn->error);
        }

        if ($result->rowCount()) {

            $row = $result->fetch();

            $photo = new Photo();
            $photo->id = $row['id'];
            $photo->path = $row['path'];
            $photo->product_id = $row['product_id'];

            return $photo;
        } else {
            return false;
        }
    }

    static public function loadPhotosByProductId(\PDO $conn, $product_id)
    {
        $productPhotos = [];
        $result = $conn->query("SELECT * FROM photo WHERE product_id =" . $product_id);

        if ($result->rowCount()) {
            while ($photoArray = $result->fetch(PDO::FETCH_ASSOC)) {
                $photo = new Photo();

                $photo->id = $photoArray['id'];
                $photo->path = $photoArray['path'];
                $photo->product_id = $product_id;

                $productPhotos[] = $photo;
            }
            return $productPhotos;
        } else {
            return false;
        }
    }

}