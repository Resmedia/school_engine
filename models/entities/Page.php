<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 03.10.19
 * Time: 20:43
 */

namespace app\models\entities;

/**
 * @param int $id
 * @param string $name
 * @param string $description
 * @param int $status
 * @param string $url
 * @param int $time_create
 * @param int $time_update
 */

class Page extends DataEntity
{
    public $id;
    public $name;
    public $description;
    public $status;
    public $url;
    public $time_create;
    public $time_update;

    const STATUS_PUBLISHED = 1;

    /**
     * Page constructor.
     * @param $id
     * @param $name
     * @param $description
     * @param $status
     * @param $url
     * @param $time_create
     * @param $time_update
     */
    public function __construct(
        $id,
        $name,
        $description,
        $status,
        $url,
        $time_create,
        $time_update
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->status = $status;
        $this->url = $url;
        $this->time_create = $time_create;
        $this->time_update = $time_update;
    }
}