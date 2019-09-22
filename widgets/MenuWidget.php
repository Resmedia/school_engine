<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 22.09.19
 * Time: 20:48
 */

namespace app\widgets;

class MenuWidget
{
    public $menus;

    function __construct($menu)
    {
        $this->menus = $menu;
        $this->run();
    }

    public function run()
    {
        $result = "";
        $subItems = [];
        $hasItems = 0;

        foreach ($this->menus as $item) {
            foreach ($this->menus as $subItem) {
                if ((int)$subItem['parent_id'] && (int)$subItem['parent_id'] == $item['id']) {
                    array_push($subItems, $subItem);
                    $hasItems = $item['id'];
                }
            }

            if ($hasItems != $item['id'] && !(int)$item['parent_id']) {
                $result .= "<li class='nav__item'>";
                $result .= "<a class='nav__link' href='{$item['url']}'>{$item['name']}</a>";
                $result .= "</li>";
            } elseif (!(int)$item['parent_id']) {
                $result .= "<li class='nav__item drop-down'>";
                $result .= "<a class='nav__link' href='{$item['url']}'>{$item['name']}</a>";
                $result .= $this->renderDropDown($subItems);
                $result .= "</li>";
            }
        }

        return $result;
    }

    private function renderDropDown(array $items): string
    {
        $result = '';

        $result .= '<ul class="drop-down__items">';
        foreach ($items as $item) {
            $result .= "<li class='nav__item'><a class='nav__link' href='{$item['url']}'>{$item['name']}</a></li>";
        }
        $result .= '</ul>';

        return $result;
    }

}