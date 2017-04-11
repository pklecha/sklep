<?php

/**
 * Created by PhpStorm.
 * User: pawel
 * Date: 24.03.17
 * Time: 23:34
 */
class PhotoTest extends AbstractDateBaseTest
{
    public function testConnection()
    {
        $pdo = $this->getConnection()->getConnection();

        $result = $pdo->query("SELECT * FROM user");
        $this->assertGreaterThan(0, $result->rowCount());
    }

    public function testLoadPhotoById()
    {
        $db = new Database();
        $photoRepository = new PhotoRepository($db);
        $photo = $photoRepository->findPhotoById(1);
        $this->assertEquals(1, $photo->getId());
        $this->assertEquals(1, $photo->getProductId());
        $this->assertEquals("/path/to/photo/1", $photo->getPath());
    }

    public function testLoadPhotosByProductId()
    {
        $db = new Database();
        $photoRepository = new PhotoRepository($db);
        $photos = $photoRepository->findPhotoByProductId(1);
        $this->assertEquals(1, $photos[1]->getId());
        $this->assertEquals(1, $photos[1]->getProductId());
        $this->assertEquals('/path/to/photo/1', $photos[1]->getPath());
        $this->assertEquals(1, $photos[1]->getProductId());
    }


//
//    public function testAddNewPhoto()
//    {
//        $photo = new Photo();
//        $photo->setPath('/path/to/the/photo');
//        $photo->setProductId(1);
//        $photo->savePhoto($this->pdo);
//        $this->assertEquals(5,$photo->getId());
//        $this->assertEquals('/path/to/the/photo', $photo->getPath());
//        $this->assertEquals(1, $photo->getProductId());
//    }
//
//    public function testUpdateDetailsOfPhoto()
//    {
//        $photo = Photo::loadPhotoById($this->pdo, 1);
//        $photo->setPath('/new/path');
//        $this->assertEquals('/new/path', $photo->getPath());
//        $photo2 = new Photo();
//        $photo2->setPath('/path/to/the/photo');
//        $photo2->setProductId(1);
//        $photo2->savePhoto($this->pdo);
//        $this->assertEquals(5, $photo2->getId());
//        $this->assertEquals('/path/to/the/photo', $photo2->getPath());
//        $photo2->setPath('changed/path');
//        $photo2->savePhoto($this->pdo);
//        $this->assertEquals('changed/path', $photo2->getPath());
//    }
}