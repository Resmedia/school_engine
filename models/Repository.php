<?php

namespace app\models;

use app\engine\App;
use app\models\entities\DataEntity;

/**
 * Class Model
 * @package app\models
 */
abstract class Repository extends Models
{

    public function deleteByIdWhere($id, $field, $value)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id  AND `$field`=:$field";
        return App::call()->db->execute($sql, ['id' => $id, "$field" => $value]);
    }

    public function getCountWhere($field, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT count(*) as count FROM {$tableName} WHERE `$field`=:$field";
        return App::call()->db->queryOne($sql, ["$field" => $value])['count'];
    }

    public function getLimit($from, $to)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT :from, :to";
        return App::call()->db->queryLimit($sql, $from, $to);
    }

    public function getWhere($field, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `$field`=:$field";
        return App::call()->db->queryObject($sql, ["$field" => $value], $this->getEntityClass());
    }

    public function getWhereAll($field, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `$field`=:$field";
        return App::call()->db->queryAll($sql, ["$field" => $value]);
    }


    public function insert(DataEntity $entity)
    {
        $keys = [];
        $attr = [];
        $tableName = $this->getTableName();

        foreach ($entity as $key => $attribute) {
            if (isset($attribute) && !is_object($attribute)) {
                $keys[] = '`' . $key . '`';
                $attr[] = '\'' . $attribute . '\'';
            }
        }
        $strKeys = implode(', ', $keys);
        $strAttr = implode(', ', $attr);

        $sql = "INSERT INTO {$tableName} ({$strKeys}) VALUES ({$strAttr})";
        return App::call()->db->execute($sql);
    }

    public function delete($entity)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return App::call()->db->execute($sql, ['id' => $entity->id]);
    }

    public function deleteAllWhere($field, $value)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE `$field`=:$field";
        return App::call()->db->execute($sql, ["$field" => $value]);
    }

    public function deleteById($id)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return App::call()->db->execute($sql, ['id' => $id]);
    }

    public function update(DataEntity $entity)
    {

        $arrEntity = (array)$entity;

        $update = [];
        $dirtyAttributes = [];
        $tableName = $this->getTableName();

        $oldAttributes = (array)$this->getOne($arrEntity['id']);

        // Look changes
        if ($oldAttributes && $arrEntity) {
            foreach ($arrEntity as $newKey => $newValue) {
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
        return App::call()->db->execute($sql, ['id' => $entity->id]);
    }

    public function save($entity)
    {
        if (is_null($entity->id)) {
            $this->insert($entity);
        } else {
            $this->update($entity);
        }

    }

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return App::call()->db->queryObject($sql, ['id' => $id], static::class);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return App::call()->db->queryAll($sql);
    }

}