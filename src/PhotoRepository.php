<?php

/**
 * Created by PhpStorm.
 * User: pawel
 * Date: 11.04.17
 * Time: 00:56
 */
class PhotoRepository
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function findPhotoById($id)
    {
        $photoData = $this->db->findById($id,'photo');
        $photo = new Photo();
        $photo->setId($photoData['id']);
        $photo->setPath($photoData['path']);
        $photo->setProductId($photoData['product_id']);
        return $photo;
    }

    public function findPhotoByProductId($productId)
    {
        $photos = [];

        $photoData = $this->db->findByParameter('photo', 'product_id', $productId);
        foreach ($photoData as $value) {
            $photo = new Photo();
            $photo->setId($value['id']);
            $photo->setPath($value['path']);
            $photo->setProductId($value['product_id']);
            $photos[$value['id']] = $photo;
        }
        return $photos;
    }
}