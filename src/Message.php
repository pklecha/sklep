<?php

/**
 * Created by PhpStorm.
 * User: Pawel
 * Date: 21.03.2017
 * Time: 22:36
 */
class Message
{
    private $id;
    private $text;
    private $userId;
    private $adminId;
    private $dateSent;

    public function __construct(User $user, Admin $admin)
    {
        $this->id = -1;
        $this->text = '';
        $this->userId = $user;
        $this->adminId = $admin;
        $this->dateSent = time();
    }

    public function sendMessage($text, User $user, Admin $admin)
    {

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return mixed
     */
    public function getAdminId()
    {
        return $this->adminId;
    }

    /**
     * @return mixed
     */
    public function getDateSent()
    {
        return $this->dateSent;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param mixed $adminId
     */
    public function setAdminId($adminId)
    {
        $this->adminId = $adminId;
    }

    public function getAllMessages()
    {

    }

    public function getAllMessagesFromAdminId (Admin $admin)
    {

    }
}