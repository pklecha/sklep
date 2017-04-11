<?php
/**
 * Created by PhpStorm.
 * User: pawel
 * Date: 07.04.17
 * Time: 23:30
 */

interface ProductRepositoryInterface
{
    public function findProductById($id);
    public function findProductByName($name);
    public function save(Product $product);
    public function remove(Product $product);
}