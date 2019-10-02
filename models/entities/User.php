<?php

namespace app\models\entities;

class User extends DataEntity
{
    public $id;
    public $name;
    public $email;
    public $role;
    public $status;
    public $password_hash;
    public $default_hash;
    public $time_create;
    public $time_update;

    const ROLE_ADMIN = 3;
    const ROLE_USER = 2;
    const ROLE_GUEST = 1;

    const STATUS_ACTIVE = 1;

    const ERRORS = [
        'email_error' => 'Email набран с ошибками!',
        'password_error' => 'Пароль имеет недопустимые знаки!',
        'password_user_error' => 'Пользователь или пароль неверный!',
        'fields_empty' => 'Все поля обязательны!',
        'user_exist' => 'Такой пользователь существует!',
        'something_wrong' => 'Что-то пошло не так!',
    ];

    public function __construct(
        int $id = null,
        string $name = null,
        string $email = null,
        int $role = null,
        string $password_hash = null,
        string $default_hash = null,
        int $status = null,
        int $time_create = null,
        int $time_update = null
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
        $this->status = $status;
        $this->password_hash = $password_hash;
        $this->default_hash = $default_hash;
        $this->time_create = $time_create;
        $this->time_update = $time_update;
    }
}