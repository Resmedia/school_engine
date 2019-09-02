<?php
$controllers = array_slice(scandir(CONTROLLERS), 2);

foreach ($controllers as $controller) {
    if ($controller != 'autoload.php') {
        include_once CONTROLLERS . $controller;
    }
}