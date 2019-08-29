<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 29.08.19
 * Time: 11:12
 */
function renderMenu(array $items)
{
    $result = "";
    $subItems = [];
    $hasItems = 0;

    foreach ($items as $item) {
        if($item['status'] == STATUS_PUBLISHED){
            foreach ($items as $subItem) {
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
                $result .= renderDropDown($subItems);
                $result .= "</li>";
            }
        }
    }

    return $result;
}

function renderDropDown(array $items): string
{
    $result = '';

    $result .= '<ul class="drop-down__items">';
    foreach ($items as $item) {
        $result .= "<li class='nav__item'><a class='nav__link' href='{$item['url']}'>{$item['name']}</a></li>";
    }
    $result .= '</ul>';

    return $result;
}