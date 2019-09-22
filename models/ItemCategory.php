<?php

namespace app\models;

/**
 * @property int $item_id
 * @property int $category_id
 */


class ItemCategory extends Model
{
    public $item_id;
    public $category_id;

    public static function getTableName()
    {
        return 'item_categories';
    }
}