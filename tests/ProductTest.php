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
        $this->assertEquals(3, $product->getId());
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
        $product2 = new Product();
        $product2->setName("New product name");
        $product2->setDescription("New product description");
        $product2->setStock(3);
        $product2->setPrice(13.22);
        $product2->setCategory($this->pdo, 1);
        $product2->saveDB($this->pdo);
        $this->assertEquals(3, $product2->getId());
        $this->assertEquals("New product name", $product2->getName());
        $this->assertEquals(3, $product2->getStock());
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
        $this->assertEquals(3, $product->getId());
        // usuniecie
        $product->delete($this->pdo);
        $this->assertFalse(Product::loadProductById($this->pdo,3));
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

    public function testGetPhotosIds()
    {
        $product = Product::loadProductById($this->pdo, 1);
        $this->assertInternalType('array', $product->getPhotosIds());
        $this->assertEquals(1, $product->getPhotosIds()[0]);
        $this->assertEquals(2, $product->getPhotosIds()[1]);
        $product2 = Product::loadProductById($this->pdo, 2);
        $this->assertInternalType('array', $product2->getPhotosIds());
        $this->assertEquals(3, $product2->getPhotosIds()[0]);
        $this->assertEquals(4, $product2->getPhotosIds()[1]);
    }

    public function testAddDeletePhotoToProduct()
    {
        $product = Product::loadProductById($this->pdo, 2);
        $photo = new Photo();
        $photo->setPath('/new/path');
        $photo->setProductId(2);
        $photo->savePhoto($this->pdo);
        $this->assertEquals(5, $photo->getId());
        $product->addPhoto($this->pdo, 5);
        $this->assertEquals(5, $product->getPhotosIds()[2]);
        $product->deletePhoto(5);
        $this->assertEquals(2, count($product->getPhotosIds()));
        $this->assertFalse($product->deletePhoto(5));
    }

    public function testGetPhotoProperties()
    {
        $product = Product::loadProductById($this->pdo, 1);
        $photo1 = $product->getPhotosIds()[0];
        $this->assertEquals('/path/to/photo/1', $product->getPhotoPath($photo1));
        $product2 = Product::loadProductById($this->pdo, 2);
        $photo2 = $product2->getPhotosIds()[0];
        $this->assertEquals('/path/to/photo/3', $product2->getPhotoPath($photo2));
    }
}