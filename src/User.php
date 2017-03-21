<?php

/**
 * Created by PhpStorm.
 * User: pawel
 * Date: 19.03.17
 * Time: 13:35
 */
class User extends BaseUser
{
    private $id;
    private $firstName;
    private $lastName;

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getAllMessages()
    {

    }

    public function getAllMessagesFromAdminId (Admin $admin)
    {

    }

    public function getOrderById(mysqli $conn, $id)
    {

    }

    public function getAllOrders(mysqli $conn)
    {

    }

    public function saveDB(mysqli $conn)
    {

    }

}