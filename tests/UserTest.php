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

        $pass = password_verify('123456', $user->getPasswordHash());
        $this->assertTrue(true, $pass);

        $user1 = User::loadUserByEmail($this->pdo, 'jan.borowka@gmail.com');
        $this->assertFalse($user1);
    }

    public function testLoadUserById()
    {
        $id = 3;
        $user = User::loadUserById($this->pdo, $id);
        $this->assertEquals(3, $user->getId());

        $user1 = User::loadUserById($this->pdo, 6);
        $this->assertFalse($user1);
    }

    public function testLoadUserAll()
    {
        $user = User::LoadUserAll($this->pdo);
        $this->assertCount(3, $user);
    }

    public function testSaveDB()
    {
        $user = new User();
        $user->setFirstName('Barbara');
        $user->setLastName('Kania');
        $user->setEmail('barbara.kania@gmail.com');
        $user->setPassword('123456');

        $user->saveDB($this->pdo);
        $user = User::LoadUserAll($this->pdo);
        $this->assertCount(4, $user);
    }

    public function testUpdateDB()
    {
        $user = User::loadUserById($this->pdo, 3);
        $user->setFirstName('Darek');
        $user->setEmail('new');
        $user->saveDB($this->pdo);

        $this->assertEquals('Darek', $user->getFirstName());
    }

    public function testDeleteDB()
    {
        $user = User::loadUserById($this->pdo, 2);
        $user->deleteDB($this->pdo);
        $user = User::LoadUserAll($this->pdo);
        $this->assertCount(2, $user);
    }
}