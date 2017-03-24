<?php

/**
 * Created by PhpStorm.
 * User: Pawel
 * Date: 21.03.2017
 * Time: 23:55
 */
class Category
{
    private $id;
    private $name;
    private $description;

    public function __construct()
    {
        $this->id = -1;
        $this->name = '';
        $this->description = '';
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }



    static public function loadCategoryById(\PDO $conn, $id)
    {
        $sql = sprintf("SELECT * FROM category WHERE id=%d", $id);
        $result = $conn->query($sql);

        if(!$result) {
            die ("Query error: " . $conn->connect_errno . ", " . $conn->error);
        }

        if ($result->rowCount()) {
            $catArray = $result->fetch();
            $category = new Category();

            $category->id = $catArray['id'];
            $category->name = $catArray['name'];
            $category->description = $catArray['description'];

            return $category;
        } else {
            return false;
        }
    }
}