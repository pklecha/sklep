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

    public function testAddNewProduct()
    {
        // tworzenie nowego obiektu z tymczasowym id -1
        $product = new Product();
        $product->setName("Product 2");
        $product->setDescription("Product 2 description");
        $product->setPrice(123.45);
        $product->setCategory($this->pdo, 1);
        $this->assertEquals(-1, $product->getId());
        $this->assertEquals("Product 2", $product->getName());
        $this->assertEquals("Product 2 description", $product->getDescription());
        $this->assertEquals(0, $product->getStock());
        $this->assertEquals(123.45, $product->getPrice());
        $this->assertEquals(1, $product->getCategoryId());
        // zapisywanie produktu do bazy
        $product->saveDB($this->pdo);
        $this->assertEquals(2, $product->getId());
    }

    public function testUpdateProduct()
    {
        $product = Product::loadProductById($this->pdo, 1);
        $product->setName("Modified Product");
        $product->setDescription("Modified Product description");
        $product->setStock(5);
        $product->setPrice(99.99);
        $product->setCategory($this->pdo, 2);
        $product->saveDB($this->pdo);
        $newProduct = Product::loadProductById($this->pdo,1);
        $this->assertEquals(1, $newProduct->getId());
        $this->assertEquals("Modified Product", $newProduct->getName());
        $this->assertEquals("Modified Product description", $newProduct->getDescription());
        $this->assertEquals(5, $newProduct->getStock());
        $this->assertEquals(99.99, $newProduct->getPrice());
        $this->assertEquals(2, $newProduct->getCategoryId());
        $this->assertEquals("Category 2", $newProduct->getCategoryName());
    }

    public function testDeleteProduct()
    {
        // tworzenie nowego produktu
        $product = new Product();
        $product->setName("Product 2");
        $product->setDescription("Product 2 description");
        $product->setPrice(123.45);
        $product->setCategory($this->pdo, 1);
        $product->saveDB($this->pdo);
        // sprawdzenie czy jest dodany do bazy
        $this->assertEquals(2, $product->getId());
        // usuniecie
        $product->delete($this->pdo);
        $this->assertFalse(Product::loadProductById($this->pdo,2));
    }

    public function testLoadProductByName()
    {
        $product = Product::loadProductByName($this->pdo, "iPhone");
        $this->assertEquals(1, $product->getId());
        $product2 = Product::loadProductByName($this->pdo, "iPh");
        $this->assertEquals(1, $product2->getId());
    }

    public function testLoadAllProducts()
    {
        $product = new Product();
        $product->setName("Product 2");
        $product->setDescription("Product 2 description");
        $product->setPrice(123.45);
        $product->setCategory($this->pdo, 1);
        $product->saveDB($this->pdo);
        // utworzenie tablicy ze wszystkimi obiektami Product
        $products = Product::loadAllProducts($this->pdo);
        // czy jest tablicą
        $this->assertTrue(is_array($products));
        // czy elementy tablicy są instancjami Product
        foreach ($products as $item) {
            $this->assertInstanceOf(Product::class, $product);
        }
        // czy mamy dostep do metod publicznych pierwszego elementu
        $this->assertEquals(1, $products[0]->getId());
        $this->assertEquals("iPhone", $products[0]->getName());
    }

    public function testGetAllPhotos()
    {
        $product = Product::loadProductById($this->pdo, 1);
        $product->setPhotos($this->pdo);
        $this->assertInternalType('array', $product->getPhotos());

    }
}