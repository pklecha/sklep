<?php

/**
 * Created by PhpStorm.
 * User: kasona
 * Date: 19.03.17
 * Time: 14:11
 */
class Order
{
    private $status;

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

}