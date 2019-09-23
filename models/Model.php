<?php

namespace app\models;

use app\interfaces\IModel;
use app\engine\Db;

/**
 * @property array $errors;
 */
abstract class Model implements IModel
{

    public static function getLimit(int $limit) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT {$limit}";
        return Db::getInstance()->queryAll($sql);
    }

   /* public static function getWhere($condition) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE {$condition}";
        return Db::getInstance()->queryAll($sql);
    }*/

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

    public function insert()
    {
        $keys = [];
        $attr = [];
        $tableName = $this->getTableName();

        foreach ($this as $key => $attribute) {
            if (isset($attribute) && !is_object($attribute)) {
                $keys[] = '`' . $key . '`';
                $attr[] = '\'' . $attribute . '\'';
            }
        }
        $strKeys = implode(', ', $keys);
        $strAttr = implode(', ', $attr);

        $sql = "INSERT INTO {$tableName} ({$strKeys}) VALUES ({$strAttr})";
        Db::getInstance()->execute($sql);
    }

    public function update()
    {
        $update = [];
        $dirtyAttributes = [];
        $tableName = $this->getTableName();

        $oldAttributes = $this->findOne(['id' => $this->id]);

        // Look changes
        if($oldAttributes && $this) {
            foreach ($this as $newKey => $newValue) {
                if ($oldAttributes[$newKey] != $newValue) {
                    $dirtyAttributes[$newKey] = $newValue;
                }
            }
        }

        // Update only changed elements
        foreach ($dirtyAttributes as $key => $attribute) {
            if (isset($attribute) && $key !== 'id' && !is_object($attribute)) {
                $update[] = "`$key` = '$attribute'";
            }
        }

        $strUpdate = implode(', ', $update);
        $sql = "UPDATE {$tableName} SET {$strUpdate} WHERE `id` = :id";
        Db::getInstance()->execute($sql, ['id' => $this->id]);
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