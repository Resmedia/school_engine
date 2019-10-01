<?php

namespace app\models\entities;

use app\models\entities\DataEntity;

class User extends DataEntity
{
    public $id;
    public $login;
    public $pass;


}