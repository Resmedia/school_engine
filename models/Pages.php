<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 18.09.19
 * Time: 9:35
 */

namespace app\models;


class Pages extends Model
{
    const STATUS_PUBLISHED = 1;

    public static function getTableName() {
        return 'pages';
    }
}