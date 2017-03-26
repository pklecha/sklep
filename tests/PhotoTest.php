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
        $photo = Photo::loadPhotoById($this->pdo, 1);
        $this->assertEquals(1, $photo->getId());
        $this->assertEquals(1, $photo->getProductId());
        $this->assertEquals("/path/to/photo", $photo->getPath());
    }

    public function testLoadPhotosByProductId()
    {
        $photo = Photo::loadPhotosByProductId($this->pdo, 1);
        $this->assertInternalType("array", $photo);
        $this->assertCount(1, $photo);
        $this->assertEquals(1, $photo[0]->getId());
        $this->assertEquals(1, $photo[0]->getProductId());
    }
}