<?php

/**
 * Created by PhpStorm.
 * User: kasona
 * Date: 19.03.17
 * Time: 13:49
 */
class ProductTest extends AbstractDateBaseTest
{
    public function testConnection()
    {
        $pdo = $this->getConnection()->getConnection();

        $result = $pdo->query("SELECT * FROM user");
        $this->assertGreaterThan(0, $result->rowCount());
    }

    public function testLoadProductById()
    {
        $id = 1;
        $product = Product::loadProductById($this->pdo,$id);
        $this->assertEquals(1, $product->getId());
    }

    public function testGetProductData()
    {
        $product = Product::loadProductById($this->pdo, 1);
        $this->assertEquals(1, $product->getId());
        $this->assertEquals('iPhone', $product->getName());
        $this->assertEquals('Apple smart phone', $product->getDescription());
        $this->assertEquals(0, $product->getStock());
        $this->assertEquals(2999.99, $product->getPrice());
    }

    public function testSetProductData()
    {
        $product = Product::loadProductById($this->pdo, 1);
        $product->setName("Galaxy S8");
        $this->assertEquals('Galaxy S8', $product->getName());
        $product->setDescription("Samsung smart phone");
        $this->assertEquals('Samsung smart phone', $product->getDescription());
        $product->setStock(1);
        $this->assertEquals(1, $product->getStock());
        $product->setPrice(2899.99);
        $this->assertEquals(2899.99, $product->getPrice());
    }

    public function testAddToStock()
    {
        $product = Product::loadProductById($this->pdo, 1);
        $product->addToStock(1);
        $this->assertEquals(1, $product->getStock());
    }

    public function testRemoveFromStock()
    {
        $product = Product::loadProductById($this->pdo, 1);
        $product->setStock(10);
        $product->removeFromStock(2);
        $this->assertEquals(8, $product->getStock());
    }

    public function testStockLowerThanZero()
    {
        $product = Product::loadProductById($this->pdo, 1);
        $product->removeFromStock(2);
        $this->assertEquals(0, $product->getStock());
    }

    public function testAddFractionalNumberToStock()
    {
        $product = Product::loadProductById($this->pdo, 1);
        $product->addToStock(5);
        $product->addToStock(1.4);
        $this->assertEquals(5, $product->getStock());
    }

    public function testRemoveFractionalNumberStock()
    {
        $product = Product::loadProductById($this->pdo, 1);
        $product->removeFromStock(1.4);
        $this->assertEquals(0, $product->getStock());
    }

    public function testAddNonNumericValueToStock()
    {
        $product = Product::loadProductById($this->pdo, 1);
        $product->addToStock("Pawel");
        $this->assertEquals(0, $product->getStock());
    }

    public function testRemoveNonNumericalValueFromStock()
    {
        $product = Product::loadProductById($this->pdo, 1);
        $product->removeFromStock("Klecha");
        $this->assertEquals(0, $product->getStock());

    }

    public function testGetCategoryData()
    {
        $product = Product::loadProductById($this->pdo, 1);
        $this->assertEquals("Category 1", $product->getCategoryName());
        $this->assertEquals("Category 1 description", $product->getCategoryDescription());
    }

}