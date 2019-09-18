<?php
namespace app\models;

/**
 * @property int $id
 * @property string $name
 */

class Category extends Model
{
    public $id;
    public $name;

    public function getTableName()
    {
        return 'categories';
    }
}