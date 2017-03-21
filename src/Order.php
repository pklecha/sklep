<?php

/**
 * Created by PhpStorm.
 * User: kasona
 * Date: 19.03.17
 * Time: 14:11
 */
class Order
{
    private $id;
    private $status;
    private $products;
    private $date;
    private $orderHistory;
    private $messages;

    public function __construct(Cart $cart)
    {
        $this->products = $cart->getProducts();
        $this->date = date();
    }

    private function getId()
    {
        return $this->id;
    }

    private function getDate()
    {
        return $this->date;
    }

    public function getOrderHistory()
    {

    }

    public function getOrderMessages()
    {

    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status, Admin $admin)
    {
        $this->status = $status;
        // TODO dodac wpis do historii
    }

}