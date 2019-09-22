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
    const STATUS_PUBLISHED = 1;

    public static function getTableName() {
        return 'menu';
    }
}