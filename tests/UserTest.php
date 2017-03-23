<?php

/**
 * Created by PhpStorm.
 * User: kasona
 * Date: 19.03.17
 * Time: 13:50
 */
class UserTest extends AbstractDateBaseTest
{

    public function testConnection()
    {
        $pdo = $this->getConnection()->getConnection();

        $result = $pdo->query("SELECT * FROM user");
        $this->assertGreaterThan(0, $result->rowCount());
    }

    public function testLoadUserByEmail()
    {
        $email = 'karol.nowak@gmail.com';
        $user = User::loadUserByEmail($this->pdo, $email);
        $this->assertEquals('karol.nowak@gmail.com', $user->getEmail());
        $this->assertEquals('Karol', $user->getFirstName());

        //  $user1 = User::loadUserByEmail($this->pdo, 'jan.borowka@gmail.com');
        //   $this->assertEquals('', $user1->getFirstName());
    }


}