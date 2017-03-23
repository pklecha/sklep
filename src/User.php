<?php

/**
 * Created by PhpStorm.
 * User: pawel
 * Date: 19.03.17
 * Time: 13:35
 */
class User extends BaseUser
{
    private $id = -1;
    private $firstName = '';
    private $lastName = '';
    private $email = '';
    private $password = '';

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

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        // później zaminić na
        // $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->password = $password;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    static public function loadUserByEmail(\PDO $conn, $email)
    {
        $sql = sprintf('SELECT * FROM user WHERE email = %d', $email);

        $result = $conn->query($sql);

        if (!$result) {
            die('Query error: ' . $conn->error);
        }

        if ($result->rowCount()) {
            $row = $result->fetch();
            $user = new User();
            $user->id = $row['id'];
            $user->firstName = $row['firstname'];
            $user->lastName = $row['lastname'];
            $user->email = $row['email'];
            $user->password = $row['password'];
            return $user;
        } else {
            return false;
        }
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