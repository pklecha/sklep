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
        $arr = $productPhotos->findPhotoByProductId($id);
        $product->setPhotos($arr);
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
            // even though there's only one element in the array we don't know its index so we have to access it through foreach loop
            foreach ($productData as $data) {
                $product = new Product();
                $product->setId($data['id']);
                $product->setName($data['name']);
                $product->setDescription($data['description']);
                $product->setPrice($data['price']);
                $product->setStock($data['stock']);
                $product->setCategoryId($data['category_id']);
                $productPhotos = new PhotoRepository($this->db);
                $product->setPhotos($productPhotos->findPhotoByProductId($data['id']));
                return $product;
            }

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