<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 18.09.19
 * Time: 9:33
 */

namespace app\models;


class Menu extends Model
{
    public function getTableName() {
        return 'menu';
    }
}