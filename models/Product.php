<?php

namespace app\models;

/**
 * @property int $id
 * @property string $name
 * @property string $full_desc
 * @property int $views
 * @property int $price
 * @property int $time_create
 * @property int $time_update
*/

class Product extends Model
{
    const STATUS_PUBLISHED = 1;

    public $id;
    public $name;
    public $full_desc;
    public $price;
    public $views;
    public $time_create;
    public $time_update;

    public static function getTableName()
    {
        return 'product';
    }

    // TODO Refactoring it like findOne() findAll() and relations hasMany to many
    public function getItemCategories(int $id): array
    {
        $itemCategories = new ItemCategory();
        $categories = new Category();

        $itemCategories = $itemCategories->findAll(['item_id' => $id]);

        $result = [];

        if(isset($itemCategories)) {
            foreach ($itemCategories as $itemCategory) {
               $categoryArr = $categories->findAll(['id' => $itemCategory['category_id']]);
                foreach ($categoryArr as $category){
                    $result[] = $category;
                }
            }
        }

        return $result;
    }
}