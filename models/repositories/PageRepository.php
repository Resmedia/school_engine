<?php


namespace app\models\repositories;


use app\models\entities\Page;
use app\models\Repository;

class PageRepository extends Repository
{

    public function getTableName()
    {
        return 'pages';
    }

    public function getEntityClass()
    {
        return Page::class;
    }
}