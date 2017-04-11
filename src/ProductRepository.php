<?php
/**
 * Created by PhpStorm.
 * User: pawel
 * Date: 07.04.17
 * Time: 23:36
 */

class ProductRepository implements \ProductRepositoryInterface
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    
    public function findProductById($id)
    {
        $productData =  $this->db->findById($id, 'product');
        $product = new Product();
        $product->setId($productData['id']);
        $product->setName($productData['name']);
        $product->setDescription($productData['description']);
        $product->setPrice($productData['price']);
        $product->setStock($productData['stock']);
        $product->setCategoryId($productData['category_id']);
        $productPhotos = new PhotoRepository($this->db);
        $product->setPhotos($productPhotos->findPhotoByProductId($id));
        return $product;
    }

    public function findProductByName($name)
    {
        $productData =  $this->db->findByParameter('product', 'name', $name);
        // ensuring number of returned products equals 1, return false if not
        // TODO handle the case of multiple results better...
        if (count($productData) > 1) {
            return false;
        } else {
            $product = new Product();
            $product->setId($productData[0]['id']);
            $product->setName($productData[0]['name']);
            $product->setDescription($productData[0]['description']);
            $product->setPrice($productData[0]['price']);
            $product->setStock($productData[0]['stock']);
            $product->setCategoryId($productData[0]['category_id']);
            $productPhotos = new PhotoRepository($this->db);
            $product->setPhotos($productPhotos->findPhotoByProductId($productData[0]['id']));
            return $product;
        }

    }

    public function save(Product $product)
    {
        $productData = [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'stock' => $product->getStock(),
            'price' => $product->getPrice(),
            'category_id' => $product->getCategoryId()
        ];
        $this->db->save($productData, 'product');
    }

    public function remove(Product $product)
    {
        $this->db->remove($product, 'product');
    }

}