<?php

/**
 * Created by PhpStorm.
 * User: pawel
 * Date: 24.03.17
 * Time: 14:51
 */
class CategoryTest extends AbstractDateBaseTest
{
    public function testConnection()
    {
        $pdo = $this->getConnection()->getConnection();

        $result = $pdo->query("SELECT * FROM category");
        $this->assertGreaterThan(1, $result->rowCount());
    }

    public function testLoadCategoryById()
    {
        $id = 1;
        $result = Category::loadCategoryById($this->pdo, $id);
        $this->assertEquals(1, $result->getId());
    }

    public function testGetCategoryData()
    {
        $category = Category::loadCategoryById($this->pdo, 1);
        $this->assertEquals(1, $category->getId());
        $this->assertEquals("Category 1", $category->getName());
        $this->assertEquals("Category 1 description", $category->getDescription());
    }

    public function testSetCategoryData()
    {
        $category = Category::loadCategoryById($this->pdo, 1);
        $category->setName("Category 2");
        $category->setDescription("Category 2 description");
        $this->assertEquals(1, $category->getId());
        $this->assertEquals("Category 2", $category->getName());
        $this->assertEquals("Category 2 description", $category->getDescription());
    }


}