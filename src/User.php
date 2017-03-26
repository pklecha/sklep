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

    public function __construct()
    {
        $this->id = -1;
        $this->firstName = '';
        $this->lastName = '';
    }

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
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    static public function loadUserByEmail(\PDO $conn, $email)
    {
        $sql = sprintf("SELECT * FROM `user` WHERE email = '%s'", $email);

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
            $user->setEmail($row['email']);
            $user->setPassword($row['password']);

            return $user;
        } else {
            return false;
        }
    }

    static public function loadUserById(\PDO $conn, $id)
    {
        $sql = sprintf("SELECT * FROM `user` WHERE id = %d", $id);

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
            $user->setEmail($row['email']);
            $user->setPassword($row['password']);

            return $user;
        } else {
            return false;
        }
    }

    static public function LoadUserAll(\PDO $conn)
    {
        $allUsers = [];

        $sql = "SELECT * FROM `user`";
        $result = $conn->query($sql);

        if($result == true && $result->rowCount() != 0) {
            foreach ($result as $row) {
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->firstName = $row['firstname'];
                $loadedUser->lastName = $row['lastname'];
                $loadedUser->setPassword($row['password']);
                $loadedUser->setEmail($row['email']);

                $allUsers[] = $loadedUser;
            }
        }
        return $allUsers;
    }


    public function saveDB(\PDO $conn)
    {
        if ($this->id === -1) {
            $sql = $conn->prepare("INSERT INTO `user` (`firstname`, `lastname`, `email`, `password`)
                        VALUES (?, ?, ?, ?);");
            $result = $sql->execute([$this->firstName, $this->lastName, $this->getEmail(), $this->getPasswordHash()]);

            if($result) {
                $this->id = $conn->lastInsertId();
                return true;
            }
            return false;
        } else {
            $sql = $conn->prepare("UPDATE `user` SET firstname=?, lastname=?, password=? WHERE id =?");
            $result = $sql->execute([$this->firstName, $this->lastName, $this->getPasswordHash(), $this->id]);

            if($result) {
                return true;
            }
            return false;
        }
    }

    public function deleteDB(\PDO $conn)
    {
        if ($this->id !== -1) {
            $sql = $conn->prepare("DELETE FROM `user` WHERE id =?");
            $result = $sql->execute([$this->id]);

            if($result) {
                $this->id = -1;
                return true;
            }
            return false;


        }
    }
}