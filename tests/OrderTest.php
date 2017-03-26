<?php

/**
 * Created by PhpStorm.
 * User: kasona
 * Date: 19.03.17
 * Time: 14:12
 */
class OrderTest extends AbstractDateBaseTest
{
    public function testConnection()
    {
        $pdo = $this->getConnection()->getConnection();

        $result = $pdo->query("SELECT * FROM user");
        $this->assertGreaterThan(0, $result->rowCount());
    }
}