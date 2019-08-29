<?php
/* DB config */
define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASS', 'root');
define('DB', 'school');

define("TEMPLATES_DIR", "../views/");
define("LAYOUTS_DIR", 'layout/');
define("IMAGES_DIR", "/gallery_img/");

include_once "../engine/db.php";
include_once "../engine/functions.php";
include_once "../engine/log.php";