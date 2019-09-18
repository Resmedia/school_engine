<?php

namespace app\interfaces;

interface IModel
{
    public function getTableName();
    public function getOne(int $id);
    public function getAll();

}