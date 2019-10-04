<?php


namespace app\tests;

use app\models\entities\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testSignUp()
    {
        $name = 'TEST2';
        $email = 'test2@test.ru';
        $user = new User(null, $name, $email, 2, null, null, 0, time(), time());

        $this->assertEquals($email, $user->email);
        $this->assertEquals($name, $user->name);
    }
}