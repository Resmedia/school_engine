<?php


namespace app\models\entities;

/**
 * Basket constructor.
 * @param int $id
 * @param int $user_id
 * @param int $session_id
 * @param string $name
 * @param string $description
 * @param string $address
 * @param string $email
 * @param string $phone
 * @param int $time_create
 * @param int $time_update
 */

class Order extends DataEntity
{
    public $id;
    public $user_id;
    public $session_id;
    public $name;
    public $description;
    public $address;
    public $email;
    public $phone;
    public $time_create;
    public $time_update;

    public function __construct(
        $id = null,
        $user_id = null,
        $session_id = null,
        $name = null,
        $description = null,
        $address = null,
        $email = null,
        $phone = null,
        $time_create = null,
        $time_update = null
    )
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->session_id = $session_id;
        $this->name = $name;
        $this->description = $description;
        $this->address = $address;
        $this->email = $email;
        $this->phone = $phone;
        $this->time_create = $time_create;
        $this->time_update = $time_update;
    }
}