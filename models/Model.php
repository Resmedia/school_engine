<?php

namespace app\models;

use app\interfaces\IModel;
use app\engine\Db;

/**
 * @property array $errors;
 */
abstract class Model implements IModel
{
    /**
     * @name save
     * @description Save new item or update dirty attributes in exist item
    */
    /*public function save()
    {
        $attributes = (array)$this;
        $dirtyAttributes = [];

        if (!isset($attributes['id'])) {
            $this->insert($attributes);
        } else {
            $items = (array)$this->getOne($attributes['id']);

            if($items && $attributes) {
                foreach ($items as $itemKey => $item) {
                    if($itemKey != 'queryString' && $attributes[$itemKey] != $item) {
                        $dirtyAttributes[$itemKey] = $attributes[$itemKey];
                    }
                }

                $this->update($attributes['id'], $dirtyAttributes);
            }
        }
    }*/

    public function getLimit($from, $to) {

    }

    public function getWere($name, $value) {

    }

    public function save() {
        if (is_null($this->id)) {
            $this->insert();
        } else {
            $this->update();
        }

    }

    public function remove()
    {
        $attributes = (array)$this;
        if (isset($attributes['id'])) {
            $this->delete($attributes['id']);
        }
    }

    /*public function insert() {
        $params = [];
        $columns = [];
        $tableName = static::getTableName();
        //TODO переделать цикл по state чтобы избавиться от условия
        foreach ($this as $key => $value) {
            if ($key === "id") continue;
            $params[":{$key}"] = $value;
            $columns[] = "`$key`";
        }
        $columns = implode(", ", $columns);
        $values = implode(", ", array_keys($params));

//INSERT INTO `products`(`id`, `name`, `description`, `price`) VALUES (:name, ,[value-4])

        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ($values);";

        Db::getInstance()->execute($sql, $params);
        $this->id = Db::getInstance()->lastInsertId();
    }*/

    public function insert()
    {
        $keys = [];
        $attr = [];
        $tableName = $this->getTableName();

        var_dump($this);

        /*foreach ($attributes as $key => $attribute) {
            if (isset($attribute) && !is_object($attribute)) {
                $keys[] = '`' . $key . '`';
                $attr[] = '\'' . $attribute . '\'';
            }
        }
        $strKeys = implode(', ', $keys);
        $strAttr = implode(', ', $attr);

        $sql = "INSERT INTO {$tableName} ({$strKeys}) VALUES ({$strAttr})";
        $this->db->execute($sql);*/
    }

    public function update(array $attributes = null)
    {
        $update = [];
        $tableName = $this->getTableName();

        foreach ($attributes as $key => $attribute) {
            if (isset($attribute) && $key !== 'id' && !is_object($attribute)) {
                $update[] = "`$key` = '$attribute'";
            }
        }

        $strUpdate = implode(', ', $update);
        $sql = "UPDATE {$tableName} SET {$strUpdate} WHERE `id` = :id";
        $this->db->execute($sql, ['id' => $this->id]);
    }

    public function delete() {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql, ['id' => $this->id]);
    }

    /**
     * @param array $params
     * @return array
     */
    public static function findOne($params = [])
    {
        $request = [];
        $tableName = static::getTableName();

        foreach ($params as $key => $param){
            $request[] = "`$key` = '$param'";
        }

        $strRequest = count($request) > 1 ? implode(' AND ', $request) : implode(',', $request) ;

        $sql = "SELECT * FROM {$tableName} WHERE {$strRequest}";

        $result = Db::getInstance()->queryOne($sql);

        return $result;
    }

    public static function findAll($params = [])
    {
        $request = [];
        $tableName = static::getTableName();

        foreach ($params as $key => $param){
            $request[] = "`$key` = $param";
        }

        $strRequest = count($request) > 1 ? implode(' AND ', $request) : implode(',', $request);

        $sql = "SELECT * FROM `{$tableName}` WHERE {$strRequest}";

        $queries = Db::getInstance()->queryAll($sql);

        return $queries;
    }

    public static function getOne($id) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->queryObject($sql, ['id' => $id], static::class);
    }
    public static function getAll() {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }
}