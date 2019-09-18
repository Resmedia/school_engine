<?php

namespace app\models;

use app\interfaces\IModel;
use app\engine\Db;

/**
 * @property array $errors;
 */
abstract class Model implements IModel
{
    /** @var $db Db */

    protected $db;
    public $errors;

    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    /**
     * @name save
     * @description Save new item or update dirty attributes in exist item
    */
    public function save()
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
    }

    public function remove()
    {
        $attributes = (array)$this;
        if (isset($attributes['id'])) {
            $this->delete($attributes['id']);
        }
    }

    public function insert(array $attributes = null)
    {
        $keys = [];
        $attr = [];
        $tableName = $this->getTableName();

        foreach ($attributes as $key => $attribute) {
            if (isset($attribute) && !is_object($attribute)) {
                $keys[] = '`' . $key . '`';
                $attr[] = '\'' . $attribute . '\'';
            }
        }
        $strKeys = implode(', ', $keys);
        $strAttr = implode(', ', $attr);

        $sql = "INSERT INTO {$tableName} ({$strKeys}) VALUES ({$strAttr})";
        $this->db->execute($sql);
    }

    public function update(int $id, array $attributes = null)
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
        $this->db->execute($sql, ['id' => $id]);
    }

    public function delete(int $id)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE `id` = :id";
        $this->db->execute($sql, ['id' => $id]);
    }

    public function findOne($params = [])
    {
        $request = [];
        $result = [];
        $tableName = $this->getTableName();
        foreach ($params as $key => $param){
            $request[] = "`$key` = '$param'";
        }

        $strRequest = count($request) > 1 ? implode(' AND ', $request) : implode(',', $request) ;

        $sql = "SELECT * FROM {$tableName} WHERE {$strRequest}";

        $queries = (array)$this->db->queryOne($sql);

        foreach ($queries as $key => $query) {
            if($key != 'queryString'){
                $result[$key] = $query;
            }
        }

        return $result;
    }

    public function findAll($params = [])
    {
        $request = [];
        $tableName = $this->getTableName();

        foreach ($params as $key => $param){
            $request[] = "`$key` = $param";
        }

        $strRequest = count($request) > 1 ? implode(' AND ', $request) : implode(',', $request);

        $sql = "SELECT * FROM `{$tableName}` WHERE {$strRequest}";

        $queries = $this->db->queryAll($sql);

        return $queries;
    }

    public function getOne(int $id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return $this->db->queryOne($sql, ['id' => $id]);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->db->queryAll($sql);
    }
}