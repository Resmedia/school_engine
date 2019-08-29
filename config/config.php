<?php
include_once "db.php";
/* DB config */
define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASS', 'root');
define('DB', 'school');

const STATUS_PUBLISHED = 1;

define("TEMPLATES_DIR", "../views/");
define("LAYOUTS_DIR", 'layout/');
define("IMAGES_DIR", "/gallery_img/");

include_once "../controllers/auth.php";
include_once "../views/widgets/FeedBackMessage.php";
include_once "../controllers/controller.php";
include_once "../controllers/messages.php";
include_once "../controllers/items.php";
include_once "../controllers/menu.php";
include_once "../controllers/core.php";
include_once "../controllers/log.php";