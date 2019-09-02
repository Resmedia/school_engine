<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 29.08.19
 * Time: 11:15
 */

function render($page, $param = [])
{
    if($page != 'cabinet'){
        return renderTemplate(LAYOUTS_DIR . "layout", ['content' => renderTemplate($page, $param)]);
    } else {
        return renderTemplate(ADMIN_DIR . "index", ['content' => renderTemplate($page, $param)]);
    }
}

function renderTemplate($page, array $params = [])
{
    ob_start();

    extract($params);

    $filename = TEMPLATES_DIR . $page . ".php";

    if (file_exists($filename)) {
        include $filename;
    } else {
        die("Страницы не существует 404");
    }

    return ob_get_clean();
}
